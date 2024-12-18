<?php
namespace App\Livewire;

use App\Models\CompanyData;
use Livewire\Component;

class CompanyInfo extends Component
{
    public $name_en;
    public $name_ar;
    public $address_en;
    public $address_ar;
    public $phone;
    public $email;
    public $website;

    public function mount()
    {
        // Load existing company information
        $companyInfo = CompanyData::first();

        if ($companyInfo) {
            $this->name_en = $companyInfo->name_en;
            $this->name_ar = $companyInfo->name_ar;
            $this->address_en = $companyInfo->address_en;
            $this->address_ar = $companyInfo->address_ar;
            $this->phone = $companyInfo->phone;
            $this->email = $companyInfo->email;
            $this->website = $companyInfo->website;
        }
    }

    public function update()
    {
        $this->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'address_en' => 'required|string|max:255',
            'address_ar' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
        ]);

        // Update or create the company information
        CompanyData::updateOrCreate(
            ['id' => 1], // Assuming there's only one record
            [
                'name_en' => $this->name_en,
                'name_ar' => $this->name_ar,
                'address_en' => $this->address_en,
                'address_ar' => $this->address_ar,
                'phone' => $this->phone,
                'email' => $this->email,
                'website' => $this->website,
            ]
        );
        if(app()->getLocale() == 'ar'){
            session()->flash('message', 'تم تحديث معلومات الشركة بنجاح.');
        }else{
            session()->flash('message', 'Company information updated successfully.');
        }
    }

    public function render()
    {
        return view('livewire.company-info')->layout('layouts.volt');
    }
}