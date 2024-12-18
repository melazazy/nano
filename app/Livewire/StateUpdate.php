<?php

namespace App\Livewire;

use App\Models\Document;
use App\Models\Notification;
use Livewire\Component;
use App\Models\ServiceRequest;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class StateUpdate extends Component
{
    use WithFileUploads;

    public $request;
    public $status;
    public $price;
    public $priceOfferDocument;
    public $priceOfferDocuments;
    public $legacyDocuments;
    public $expiry_date;
    public $expiration_date;

    public function mount($id)
    {
        $this->request = ServiceRequest::with(['service', 'user', 'documents'])->findOrFail($id);

        if (!Auth::user()->is_admin && Auth::id() !== $this->request->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $this->status = $this->request->status;
        $this->price = $this->request->price;
        // $this->expiry_date = $this->request->expiry_date;
        // $this->expiration_date = $this->expiry_date;
        $this->expiry_date = $this->request->expiry_date
            ? Carbon::parse($this->request->expiry_date)->format('Y-m-d\TH:i') // Format for datetime-local
            : null;
        $this->expiration_date = $this->expiry_date;
        // $this->expiry_date = $expiry_date ? Carbon::parse($expiry_date) : null;

        // dd($this->request);
        // $docs = $this->loadDocuments();
        $this->loadDocuments();
    }

    public function loadDocuments()
    {
        // Load documents from the documents table
        $this->priceOfferDocuments = $this->request->documents()->latest()->get()->toArray();
    }

    public function updateStatus()
    {
        $this->validate([
            'status' => 'required|in:pending,in_progress,completed,canceled',
        ]);

        $this->request->status = $this->status;

        if ($this->request->save()) {
            if (app()->getLocale() == 'ar') {
                session()->flash('message', 'تم تحديث حالة الطلب بنجاح.');
            } else {
                session()->flash('message', 'Request status updated successfully.');
            }
        } else {
            if (app()->getLocale() == 'ar') {
                session()->flash('error', 'خطأ في تحديث حالة الطلب.');
            } else {
                session()->flash('error', 'Failed to update request status.');
            }
        }
    }
    public function updateRequest()
    {

        $this->validate([
            'status' => 'required|in:pending,in_progress,completed,canceled',
            'price' => 'nullable|numeric|min:0',
            'expiry_date' => 'required|date|after:now', // Ensure the date is in the future
        ]);

        try {
            // echo('Current Expiry Date before update: ' . $this->expiry_date);

            $this->request->status = $this->status;
            $this->request->price = $this->price;
            $this->request->expiry_date = Carbon::parse($this->expiry_date);
            $this->expiration_date = $this->expiry_date;

            if ($this->request->save()) {
                Log::info('Request Updated', [
                    'request_id' => $this->request->id,
                    'new_status' => $this->status,
                    'new_price' => $this->price
                ]);
                Notification::create([
                    'user_id' => $this->request->user_id,
                    'request_id' => $this->request->id,
                    'en_title' => 'Update Request status',
                    'ar_title' => 'تحديث حالة الطلب',
                    'en_message' => " check the status of your request.",
                    'ar_message' => "تحقق من حالة الطلب الخاص بك.",
                    'is_read' => false,
                    'created_at' => now()
                ]);
                if (app()->getLocale() == 'ar') {
                    session()->flash('message', 'تم تحديث حالة الطلب بنجاح.');
                } else {
                    session()->flash('message', 'Request updated successfully.');
                }
                $this->expiration_date = $this->request->expiry_date;
            } else {
                throw new \Exception('Failed to save request');
            }
        } catch (\Exception $e) {
            Log::error('Request Update Error: ' . $e->getMessage());
            if (app()->getLocale() == 'ar') {
                session()->flash('error', 'خطأ في تحديث الطلب: ' . $e->getMessage());
            } else {
                session()->flash('error', 'Error updating request: ' . $e->getMessage());
            }
        }
    }
    public function uploadPriceOffer()
    {
        $this->validate([
            'priceOfferDocument' => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB max
        ]);

        try {
            if (!$this->priceOfferDocument) {
                throw new \Exception('No file uploaded');
            }

            $file = $this->priceOfferDocument;
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('documents', $filename, 'public');
            // dd($this->request);
            $document = Document::create([
                'user_id' => Auth::id(),
                'service_id' => $this->request->service_id,
                'request_id' => $this->request->id,
                'file_url' => $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize()
            ]);

            Log::info('Document Uploaded', [
                'request_id' => $this->request->id,
                'document_id' => $document->id,
                'file_name' => $filename
            ]);

            $this->priceOfferDocument = null;
            $this->loadDocuments();
            // Create a notification for the user
            Notification::create([
                'user_id' => $this->request->user_id,
                'request_id' => $this->request->id,
                'en_title' => 'Update Request',
                'en_message' => "Add Price Offer Document to Your service request.",
                'ar_title' => 'تحديث في حالة الطلب',
                'ar_message' => 'تم إضافة ملف عرض سعر لطلبك.',
                'is_read' => false,
                'created_at' => now(),

            ]);
            if (app()->getLocale() == 'ar') {
                session()->flash('message', 'تم إضافة ملف عرض سعر لطلبك بنجاح.');
            } else {
                session()->flash('message', 'Document uploaded successfully.');
            }
        } catch (\Exception $e) {
            Log::error('Document Upload Error: ' . $e->getMessage());
            if (app()->getLocale() == 'ar') {
                session()->flash('error', 'خطأ في تحديث الطلب: ' . $e->getMessage());
            } else {
                session()->flash('error', 'Error uploading document: ' . $e->getMessage());
            }
        }
    }
    public function deleteDocument($documentId)
    {
        $document = Document::find($documentId);
        if ($document) {
            // dd($document);
            // Delete the file from storage
            Storage::delete($document->file_url);
            // Delete the document record from the database
            $document->delete();
            if (app()->getLocale() == 'ar') {
                session()->flash('message', 'تم حذف الملف بنجاح.');
            } else {
                session()->flash('message', 'Document deleted successfully.');
            }
            $this->loadDocuments();
        } else {
            if (app()->getLocale() == 'ar') {
                session()->flash('error', 'الملف غير موجود.');
            } else {
                session()->flash('error', 'Document not found.');
            }
        }
    }

    public function render()
    {
        return view('livewire.state-update')->layout('layouts.volt');
    }
}
