<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Service;
use App\Models\ServiceRequest as ServiceRequestModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ServiceRequest extends Component
{
    use WithFileUploads;

    // Public properties
    public $services;
    public $service_id;
    public $documents = [];
    public $title_en = []; // Titles for English files
    public $title_ar = []; // Titles for Arabic files
    public $filesCount=0;
    public $notes;
    // public $users;

    // Validation rules
    protected $rules = [
        'service_id' => 'required|exists:services,id',
        'documents.*' => 'nullable|file|max:1024', // 1MB Max
        'title_en.*' => 'nullable|string|max:255', // Title validation for English
        'title_ar.*' => 'nullable|string|max:255', // Title validation for Arabic
        'notes' => 'nullable|string|max:500',
    ];

    // Custom error messages (optional)
    protected $messages = [
        'service_id.required' => 'Please select a service.',
        'service_id.exists' => 'The selected service is invalid.',
        'documents.*.max' => 'Each document must be less than 1MB.',
        'title_en.*.max' => 'Each English title must not exceed 255 characters.',
        'title_ar.*.max' => 'Each Arabic title must not exceed 255 characters.',
        'notes.max' => 'Notes cannot exceed 500 characters.',
    ];

    // Lifecycle method
    public function mount()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('home')->with('error', __('You do not have access to this page.'));
        }
        // dd(Auth::user());
        $this->services = Service::where('status', 'active')->get();
        // $this->filesCount=$this->services();
        // $this->users = User::where('role', '!=', 'admin')->get();
        $this->service_id = request()->query('service_id');; // Set the default selected service
        // query the service with the selected id and get the service file count
        $service = Service::find($this->service_id);
        $this->filesCount = $service->file_count ?? 0;
          // Save the service request
          if($this->filesCount>0){
              $this->title_en = explode(',', $service->title_en); // Save English titles
              $this->title_ar = explode(',', $service->title_ar); // Save Arabic titles
          }

    }

    // File upload handler
    private function handleFileUploads()
    {
        $uploadedFiles = [];

        if ($this->documents) {
            $documents = is_array($this->documents) ? $this->documents : [$this->documents];
            // dd($documents);
            foreach ($this->documents as $index => $document) {
                try {
                    // Retrieve user details
                    $userId = auth::user()->id;
                    $username = auth::user()->name;

                    // Construct the new file name
                    $originalName = pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $document->getClientOriginalExtension();
                    // $newFileName = "{$this->title_en[0]}_{$originalName}_{$userId}_{$username}.{$extension}";


                    $title = $this->title_en[$index] ?? 'Required_file_'.$index; // Fallback to 'default_title' if no title exists
                    $newFileName = "{$title}_{$userId}_{$username}.{$extension}";

                    // Log file details for debugging
                    Log::info('Uploading Document', [
                        'original_name' => $document->getClientOriginalName(),
                        'name' => $newFileName,
                        'mime_type' => $document->getMimeType(),
                        'size' => $document->getSize()
                    ]);

                    // Store the file
                    // $path = $document->store('documents', 'public');
                    $path = $document->storeAs('documents', $newFileName, 'public');

                    $uploadedFiles[] = $path;
                } catch (\Exception $e) {
                    Log::error('File Upload Error', [
                        'error' => $e->getMessage(),
                        'file' => $document->getClientOriginalName()
                    ]);
                }
            }
        }
        return $uploadedFiles;
    }

    public function updatedServiceId($value)
{
    // Reset documents and titles when the service changes
    $this->documents = [];
    $this->title_en = [];
    $this->title_ar = [];

    // Query the selected service to get the file count and titles
    $service = Service::find($value);

    if ($service) {
        $this->filesCount = $service->file_count ?? 0;
        $this->title_en = explode(',', $service->title_en); // Save English titles
        $this->title_ar = explode(',', $service->title_ar); // Save Arabic titles
    }
}
    // Form submission method
    public function submit()
    {
        // Validate input
        $validatedData = $this->validate();

        try {
            // Log submission details for debugging
            Log::info('Service Request Submission', [
                'user_id' => Auth::id(),
                'service_id' => $this->service_id,
                'notes' => $this->notes,
                'documents_count' => count($this->documents),
                'titles_en' => $this->title_en,
                'titles_ar' => $this->title_ar,
            ]);

            // Create new service request
            $serviceRequest = new ServiceRequestModel();
            $serviceRequest->service_id = $this->service_id;
            $serviceRequest->user_id = Auth::id();
            $serviceRequest->notes = $this->notes;
            $serviceRequest->status = 'pending';
            $serviceRequest->price = 0.00;
            $serviceRequest->expiry_date = Carbon::now()->addDays(30);

            // Handle file uploads
            $uploadedFiles = $this->handleFileUploads();
            $serviceRequest->documents = $uploadedFiles;


             $serviceRequest->save();

            // Create a notification for the user
        Notification::create([
            'user_id' => Auth::id(),
            'request_id' => $serviceRequest->id,
            'ar_title' => 'طلب خدمة جديد',
            'ar_message' => "تم تقديم طلب الخدمة بنجاح",
            'en_title' => 'New Service Request',
            'en_message' => "Service request submitted successfully",
            'is_read' => false,
            'created_at' => now()
        ]);
        // Notify admins about the new request
        $adminUsers = User::where('is_admin', true)->get();
        foreach ($adminUsers as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'request_id' => $serviceRequest->id,
                'ar_title' => 'طلب خدمة جديد',
                'ar_message' => " تم تقديم طلب الخدمة بنجاح من قبل " . Auth::user()->name,
                'en_title' => 'New Service Request',
                'en_message' => "A new service request has been created by " . Auth::user()->name,
                'is_read' => false,
                'created_at' => now()
            ]);
        }

            // Reset form fields
            $this->reset(['service_id', 'documents', 'notes']);

            // Flash success message
            if (app()->getLocale() == 'ar') {
                session()->flash('success', 'تم إرسال طلب الخدمة بنجاح.');
            }else{
                session()->flash('success', 'Service request submitted successfully.');
            }
        } catch (\Exception $e) {
            // Log any unexpected errors
            Log::error('Service Request Submission Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Flash error message
            if(app()->getLocale() == 'ar'){
                session()->flash('error', 'حدث خطأ أثناء إرسال طلب الخدمة. يرجى المحاولة مرة أخرى.');
            }else{
                session()->flash('error', 'An error occurred while submitting your request. Please try again.');
            }
        }
    }

    // Render method
    public function render()
    {
        return view('livewire.pages.service-request')->layout('layouts.volt');
    }
}
