<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceCreate extends Component
{
    use WithFileUploads;

    public $serviceId = null;
    public $en_name = '';
    public $en_description = '';
    public $ar_name = '';
    public $ar_description = '';
    public $icon = '';
    public $image = null;
    public $status = 'active';
    public $existingImage = null;
    public $file_count = 0; // Default to 0 file
    public $title_en = []; // عناوين الملفات باللغة الإنجليزية
    public $title_ar = []; // عناوين الملفات باللغة العربية

    public function mount($id = null)
    {
        if ($id) {
            $this->serviceId = $id;
            $this->loadService($id);
            // dd($this);
        }
    }

    public function loadService($id)
    {
        $service = Service::findOrFail($id);
        $this->en_name = $service->en_name;
        $this->en_description = $service->en_description;
        $this->ar_name = $service->ar_name;
        $this->ar_description = $service->ar_description;
        $this->icon = $service->icon;
        $this->status = $service->status;
        $this->existingImage = $service->image_url;
        $this->file_count = isset($service->file_count) ? $service->file_count : 0;
        $this->title_en = isset($service->title_en) ? explode(',', $service->title_en): [];
        $this->title_ar = isset($service->title_ar) ? explode(',', $service->title_ar) : [];
    }

    protected function rules()
    {
        $rules = [
            'en_name' => 'required|string|max:255',
            'en_description' => 'required|string',
            'ar_name' => 'required|string|max:255',
            'ar_description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048', // Max 2MB
            'status' => 'required|in:active,inactive',
            'file_count' => 'nullable|integer|min:0',
            'title_en.*' => 'nullable|string|max:255',
            'title_ar.*' => 'nullable|string|max:255',
        ];

        // If it's a new service, make en_name and ar_name unique
        if (!$this->serviceId) {
            $rules['en_name'] .= '|unique:services,en_name';
            $rules['ar_name'] .= '|unique:services,ar_name';
        } else {
            // If editing, make en_name and ar_name unique except for current service
            $rules['en_name'] .= '|unique:services,en_name,' . $this->serviceId;
            $rules['ar_name'] .= '|unique:services,ar_name,' . $this->serviceId;
        }

        return $rules;
    }

    public function save()
    {
        // Validate all inputs
        $validatedData = $this->validate();

        // Prepare image upload
        $imageName = $this->existingImage;
        if ($this->image) {
            try {
                // Sanitize service name for filename
                $sanitizedName = Str::slug($this->en_name);

                // Generate unique filename
                $uniqueString = Str::random(10);
                $imageName = "{$sanitizedName}-{$uniqueString}." . $this->image->getClientOriginalExtension();

                // Store the file using Laravel's Storage facade
                $path = $this->image->storeAs(
                    'services/images',
                    $imageName,
                    'public'
                );

                // Delete old image if exists and we're updating
                if ($this->serviceId && $this->existingImage) {
                    Storage::disk('public')->delete('services/images/' . $this->existingImage);
                }

                Log::channel('stderr')->info('Image Storage Details', [
                    'original_name' => $this->image->getClientOriginalName(),
                    'stored_name' => $imageName,
                    'path' => $path,
                ]);
            } catch (\Exception $e) {
                Log::channel('stderr')->error('Image Upload Failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                if(app()->getLocale() == 'ar'){
                    session()->flash('error', 'فشل تحميل الصورة.');
                }else{
                    session()->flash('error', 'Image upload failed: ' . $e->getMessage());
                }
                return back();
            }
        }

       // Create or update service
        try {
            if ($this->serviceId) {
                // Update existing service
                $service = Service::findOrFail($this->serviceId);
                $service->update([
                    'en_name' => $this->en_name,
                    'en_description' => $this->en_description,
                    'ar_name' => $this->ar_name,
                    'ar_description' => $this->ar_description,
                    'icon' => $this->icon,
                    'image_url' => $imageName,
                    'status' => $this->status,
                    'file_count' => $this->file_count,
                    'title_en' => implode(',', $this->title_en), // Store English titles
                    'title_ar' => implode(',', $this->title_ar), // Store Arabic titles
                ]);
                session()->flash('message', 'Service updated successfully.');
            } else {
                // Create new service
                $service = Service::create([
                    'en_name' => $this->en_name,
                    'en_description' => $this->en_description,
                    'ar_name' => $this->ar_name,
                    'ar_description' => $this->ar_description,
                    'icon' => $this->icon,
                    'image_url' => $imageName,
                    'status' => $this->status,
                    'file_count' => $this->file_count,
                    'title_en' => implode(',', $this->title_en), // Store English titles
                    'title_ar' => implode(',', $this->title_ar), // Store Arabic titles
                ]);
                session()->flash('message', 'Service created successfully.');
                // Reset form
            $this->reset();
            $this->image = null;

            return redirect()->route('create.service');
            }

            Log::channel('stderr')->info('Service Saved', [
                'service_id' => $service->id,
                'image_name' => $imageName,
            ]);
        } catch (\Exception $e) {
            Log::channel('stderr')->error('Service Save Failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            session()->flash('error', 'Failed to save service: ' . $e->getMessage());
            return back();
        }
    }

    public function render()
    {
        return view('livewire.service-create')->layout('layouts.volt');
    }
}
