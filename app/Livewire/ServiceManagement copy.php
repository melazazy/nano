<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

class ServiceManagement extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $icon;
    public $image;
    public $status = 'active';
    public $service;

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'required',
        'icon' => 'required',
        'image' => 'required|image|max:2048', // 2MB max
        'status' => 'required|in:active,inactive'
    ];

    public function mount(Service $service = null)
    {
        if ($service) {
            $this->service = $service;
            $this->name = $service->name;
            $this->description = $service->description;
            $this->icon = $service->icon;
            $this->status = $service->status;
        }
    }

    public function save()
    {
        $this->validate();

        if (!$this->service) {
            $this->service = Service::create([
                'name' => $this->name,
                'description' => $this->description,
                'icon' => $this->icon,
                'status' => $this->status
            ]);
        } else {
            $this->service->update([
                'name' => $this->name,
                'description' => $this->description,
                'icon' => $this->icon,
                'status' => $this->status
            ]);
        }

        if ($this->image) {
            $this->service->uploadImage($this->image);
        }

        $this->reset(['name', 'description', 'icon', 'image']);
        session()->flash('message', 'Service saved successfully.');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $services = Service::all();
        return view('livewire.service-management', [
            'services' => $services
        ]);
    }
}