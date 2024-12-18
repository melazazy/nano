<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ServiceRequest;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;




class ManageRequests extends Component
{
    use WithPagination;
    public $requests;
    public $showModal = false; // Modal visibility
    public $editRequest; // Request being edited
    public $statusFilter = '';
    public $paginationLinks;

    protected $paginationTheme = 'bootstrap'; // Optional: Set pagination theme


    public function mount()
    {
        $this->loadRequests();
    }

    public function loadRequests()
    {
        $paginator = ServiceRequest::with(['user', 'service'])
            ->when(!Auth::user()->is_admin, function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $this->requests = $paginator->toArray();
        $this->paginationLinks = $paginator->links()->render(); // Save rendered pagination links
    }


    public function updatedStatusFilter()
    {
        // dd($this->statusFilter); // This will dump the current status filter value.

        $this->loadRequests();
    }

    public function edit($requestId)
    {
        // Check if the user is authorized to edit
        $request = ServiceRequest::findOrFail($requestId);
        if (Auth::user()->is_admin || $request->user_id == Auth::id()) {
            // Open modal or perform inline editing
            // $this->editRequest = $request;
            $this->editRequest = $request->toArray(); // Ensure it's an array for binding
            $this->editRequest['documents'] = $this->editRequest['documents'] ?? [];
            $this->showModal = true;
        } else {
            if(app()->getLocale() == 'ar'){
                session()->flash('error', 'لا يمكنك تحديث الطلب.');
            }else{
                session()->flash('error', 'You are not authorized to edit this request.');
            }
        }
    }

    public function save()
    {
        // dd('Edit Request Data:', $this->editRequest);

        $rules = [
            'editRequest.price' => 'nullable|numeric',
            'editRequest.documents' => 'nullable|string|max:255',
        ];

        if (Auth::user()->is_admin) {
            $rules = array_merge($rules, [
                'editRequest.notes' => 'nullable|string|max:500',
                'editRequest.expiry_date' => 'nullable|date',
                'editRequest.service_id' => 'required|exists:services,id',
                // 'editRequest.status' => 'required|in:active,inactive',
                'editRequest.status' => 'required|in:pending,in_progress,completed,canceled',
            ]);
        }

        $this->validate($rules);

        try {
            // Get the original request before changes
            $originalRequest = ServiceRequest::find($this->editRequest['id']);
            $statusChanged = $originalRequest->status !== $this->editRequest['status'];

            // Save the request changes
            $request = ServiceRequest::findOrFail($this->editRequest['id']);
            $request->fill($this->editRequest);
            $request->save();

            // Create notifications
            $this->createNotifications($request, $statusChanged, $originalRequest->status);

            $this->showModal = false;
            if(app()->getLocale() == 'ar'){
                session()->flash('success', 'تم تحديث الطلب بنجاح.');
            }else{
                session()->flash('success', 'Request updated successfully.');
            }
            $this->requests = ServiceRequest::with(['user', 'service'])->get();

        } catch (\Exception $e) {
            Log::error('Request Update Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            if(app()->getLocale() == 'ar'){
                session()->flash('error', 'حدث خطأ أثناء تحديث الطلب. يرجى المحاولة مرة أخرى.');
            }else{
                session()->flash('error', 'An error occurred while updating the request. Please try again.');
            }
        }
    }
    private function createNotifications($request, $statusChanged, $oldStatus)
    {
        // Create notification for the user
        Notification::create([
            'user_id' => $request->user_id,
            'request_id' => $request->id,
            'title' => 'Request Updated',
            'message' => "Your service request has been updated.",
            'is_read' => false,
            'created_at' => now()
        ]);

        // If status changed, create a more specific notification
        if ($statusChanged) {
            Notification::create([
                'user_id' => $request->user_id,
                'request_id' => $request->id,
                'title' => 'Request Status Changed',
                'message' => "Your request status has changed from {$oldStatus} to {$request->status}.",
                'is_read' => false,
                'created_at' => now()
            ]);
        }

        // If price was updated, create a price update notification
        if ($request->wasChanged('price')) {
            Notification::create([
                'user_id' => $request->user_id,
                'request_id' => $request->id,
                'title' => 'Price Updated',
                'message' => "The price for your request has been updated to $" . number_format($request->price, 2),
                'is_read' => false,
                'created_at' => now()
            ]);
        }

        // Notify admins about new requests
        if ($request->wasRecentlyCreated) {
            $adminUsers = \App\Models\User::where('is_admin', true)->get();
            foreach ($adminUsers as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'request_id' => $request->id,
                    'title' => 'New Service Request',
                    'message' => "A new service request has been created by {$request->user->name}.",
                    'is_read' => false,
                    'created_at' => now()
                ]);
            }
        }
    }
    public function delete($requestId)
    {
        try {
            $request = ServiceRequest::findOrFail($requestId);
            if (Auth::user()->is_admin || $request->user_id == Auth::id()) {
                $request->delete();
                if(app()->getLocale() == 'ar'){
                    session()->flash('success', 'تم حذف الطلب بنجاح.');
                }else{
                    session()->flash('success', 'Request deleted successfully.');
                }
                $this->requests = ServiceRequest::with(['user', 'service'])->get(); // Refresh the list
            } else {
                if(app()->getLocale() == 'ar'){
                    session()->flash('error', 'لا يمكنك حذف الطلب.');
                }else{
                    session()->flash('error', 'You are not authorized to delete this request.');
                }
            }
        } catch (\Exception $e) {
            Log::error('Request Deletion Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            if(app()->getLocale() == 'ar'){
                session()->flash('error', 'حدث خطأ أثناء حذف الطلب. يرجى المحاولة مرة أخرى.');
            }else{
                session()->flash('error', 'An error occurred while deleting the request. Please try again.');
            }
        }
    }

    public function addDocument()
    {
        $this->editRequest['documents'][] = '';
    }

    public function removeDocument($index)
    {
        unset($this->editRequest['documents'][$index]);
        $this->editRequest['documents'] = array_values($this->editRequest['documents']); // Re-index the array
    }
    public function render()
    {
        // $this->loadRequests(); // Ensure requests are loaded based on the current filter
            return view('livewire.manage-requests', [
                'requests' => $this->requests,
        ])->layout('layouts.volt');
    }
}
