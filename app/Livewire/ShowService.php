<?php

namespace App\Livewire;

use App\Models\CompanyData;
use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ShowService extends Component
{
    public Service $service;
    public $companyInfo;
    public $message;

    public function mount(Service $service)
    {
        $this->companyInfo = CompanyData::first();
        $this->service = $service;
    }

    public function getWhatsAppLink()
    {
        if(app()->getLocale() == 'en') {
            $this->message = "Hello, I'm interested in the {$this->service->en_name} service.";
        } else {
            $this->message = "مرحبا، أنا أرغب في خدمة {$this->service->ar_name}.";
        }
        // Replace with your WhatsApp number

        $phoneNumber = $this->companyInfo ? $this->companyInfo->phone : env('COMPANY_PHONE');
        return "https://wa.me/{$phoneNumber}?text=" . urlencode($this->message);
    }

    public function requestService()
    {
        return redirect()->route('request.service');
    }

    // #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.show-service')->layout('layouts.gold');;
    }
}
