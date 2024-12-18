<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class ManageServices extends Component
{
    public $services;
    public $showModal = false; // Modal visibility
    public $editService; // Service being edited

    public function mount()
    {
        $this->services = Service::orderBy('created_at', 'desc')->get();
    }

    public function edit($serviceId)
    {
        $service = Service::findOrFail($serviceId);
        if (Auth::user()->is_admin) {
            $this->editService = $service->toArray();
            $this->showModal = true;
        } else {
            if(app()->getLocale() == 'ar'){
                session()->flash('error', 'لا يمكنك تحديث الخدمة.');
            }else{
                session()->flash('error', 'You are not authorized to edit this service.');
            }
        }
    }

    public function delete($serviceId)
    {
        $service = Service::findOrFail($serviceId);
        if (Auth::user()->is_admin) {
            $service->delete();
            if(app()->getLocale() == 'ar'){
                session()->flash('success', 'تم حذف الخدمة بنجاح.');
            }else{
                session()->flash('success', 'Service deleted successfully.');
            }
            $this->mount(); // Refresh the service list
        } else {
            if(app()->getLocale() == 'ar'){
                session()->flash('error', 'لا يمكنك حذف الخدمة.');
            }else{
                session()->flash('error', 'You are not authorized to delete this service.');
            }
        }
    }

    public function save()
    {
        // Validate and save the changes
        $rules = [
            'editService.name' => 'required|string|max:255',
            'editService.description' => 'nullable|string|max:500',
        ];
        $this->validate($rules);
        Service::find($this->editService['id'])->update($this->editService);
        $this->showModal = false;
        if(app()->getLocale() == 'ar'){
            session()->flash('success', 'تم تحديث الخدمة بنجاح.');
        }else{
            session()->flash('success', 'Service updated successfully.');
        }
    }

    public function render()
    {
        return view('livewire.manage-services')->layout('layouts.volt');
    }
}
