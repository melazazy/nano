<?php

namespace App\Livewire;

use App\Models\ServiceRequest;
use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ShowRequest extends Component
{
    use WithFileUploads;

    public $request;
    public $status;
    public $price;
    public $priceOfferDocument;
    public $priceOfferDocuments;
    public $legacyDocuments;
    public $confirmDeleteId = null;

    public function mount($id)
    {
        $this->request = ServiceRequest::with(['service', 'user', 'documents'])->findOrFail($id);

        if (!Auth::user()->is_admin && Auth::id() !== $this->request->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $this->status = $this->request->status;
        $this->price = $this->request->price;
        $this->loadDocuments();
    }


    public function updateRequest()
    {

        // dd('Updating');
        $this->validate([
            'status' => 'required|in:pending,active,in_progress,completed,cancelled',
            'price' => 'nullable|numeric|min:0'
        ]);

        try {
            $this->request->status = $this->status;
            $this->request->price = $this->price;

            if ($this->request->save()) {
                Log::info('Request Updated', [
                    'request_id' => $this->request->id,
                    'new_status' => $this->status,
                    'new_price' => $this->price
                ]);
                if(app()->getLocale() == 'ar'){
                    session()->flash('message', 'تم تحديث الطلب بنجاح.');
                }else{
                    session()->flash('message', 'Request updated successfully.');
                }
            } else {
                throw new \Exception('Failed to save request');
            }
        } catch (\Exception $e) {
            Log::error('Request Update Error: ' . $e->getMessage());
            if(app()->getLocale() == 'ar'){
                session()->flash('error', 'خطأ في تحديث الطلب: ' . $e->getMessage());
            }else{
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
            // change session message depending on the lang vlaue
            if (app()->getLocale() == 'en') {
                session()->flash('message', 'Document uploaded successfully.');
            } else {
                session()->flash('message', 'تم تحميل المستند بنجاح.');
            }

        } catch (\Exception $e) {
            Log::error('Document Upload Error: ' . $e->getMessage());
            if(app()->getLocale() == 'ar'){
                session()->flash('error', 'خطأ في تحميل المستند: ' . $e->getMessage());
            }else{
                session()->flash('error', 'Error uploading document: ' . $e->getMessage());
            }
        }
    }
    public function confirmDelete($documentId)
    {
        dd($documentId);
        $this->confirmDeleteId = $documentId;
        $this->dispatchBrowserEvent('confirm-delete', ['id' => $documentId]);
    }

    public function deleteDocument($documentId)
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }
        dd($documentId);
        try {
            $document = Document::findOrFail($documentId);

            if (Storage::disk('public')->exists($document->file_url)) {
                Storage::disk('public')->delete($document->file_url);
            }

            $document->delete();

            $this->loadDocuments();
            if(app()->getLocale() == 'ar'){
                session()->flash('message', 'تم حذف المستند بنجاح.');
            }else{
                session()->flash('message', 'Document deleted successfully.');
            }
        } catch (\Exception $e) {
            Log::error('Document Deletion Error: ' . $e->getMessage());
            if(app()->getLocale() == 'ar'){
                session()->flash('error', 'خطأ في حذف المستند: ' . $e->getMessage());
            }else{
                session()->flash('error', 'Error deleting document: ' . $e->getMessage());
            }
        }
    }

    public function loadDocuments()
    {
        // Load documents from the documents table
        $this->priceOfferDocuments = $this->request->documents()->latest()->get();

        // Load legacy documents from the JSON column
        $this->legacyDocuments = collect($this->request->documents ?? [])->map(function ($doc) {
            return [
                'name' => $doc['name'] ?? 'Unknown',
                'path' => $doc['path'] ?? '',
                'type' => $doc['type'] ?? 'document',
                'uploaded_at' => $doc['uploaded_at'] ?? now()->toDateTimeString()
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.pages.show-request')->layout('layouts.gold');

    }
}
