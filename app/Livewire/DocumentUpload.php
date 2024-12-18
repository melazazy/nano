<?php

namespace App\Livewire;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class DocumentUpload extends Component
{
    use WithFileUploads;

    public $document;
    public $service_id;
    public $request_id;

    public function mount($service_id, $request_id)
    {
        $this->service_id = $service_id;
        $this->request_id = $request_id;
    }

    public function render()
    {
        return view('livewire.document-upload');
    }

    public function uploadDocument()
    {
        $this->validate([
            'document' => 'required|file|max:10240', // 10MB max
        ]);

        $path = $this->document->store('documents', 'public');

        $document = Document::create([
            'user_id' => auth()->user->id(),
            'service_id' => $this->service_id,
            'request_id' => $this->request_id,
            'file_path' => $path,
            'file_name' => $this->document->getClientOriginalName(),
        ]);

        $this->reset('document');
        $this->dispatch('document-uploaded', documentId: $document->id);
    }
}
