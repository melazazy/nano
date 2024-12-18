<?php

namespace App\Livewire\Pages;

use App\Models\CompanyData;
use Livewire\Component;
use App\Models\Service;

class Goldenspeed extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';
    public $phoneNumber;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    public function mount()
    {
        // Initialize any data if needed
        $companyInfo = CompanyData::first();
        $this->phoneNumber = $companyInfo ? $companyInfo->phone : env('COMPANY_PHONE');
    }

    public function render()
    {
        return view('livewire.pages.goldenspeed', [
            'services' => $this->getServices(),
            'stats' => $this->getStats(),
            'features' => $this->getFeatures(),
            'phoneNumber' => $this->phoneNumber,
        ])->layout('layouts.gold');
    }

    public function submitContact()
    {
        $this->validate();

        // Here you would typically send an email or save to database
        if(app()->getLocale() == 'ar'){
            session()->flash('message', 'شكراً لك على رسالتك. سنعود إليك قريباً!');
        }else{
            session()->flash('message', 'Thank you for your message. We\'ll get back to you soon!');
        }

        $this->reset(['name', 'email', 'message']);
    }

    private function getServices()
    {
        // get the language from the session
        $lang = app()->getLocale();
        // dd($lang);
        // change return depend on the $lang if ar return ar-name and ar-description else return en-name and en-description
        if($lang == 'ar'){
            return Service::where('status', 'active')->orderBy('created_at', 'desc')->get()->map(function ($service, $index) {
                return [
                    'id' => $service->id,
                    'icon' => $service->icon,
                    'title' => $service->ar_name,
                    'description' => $service->ar_description,
                    'image' => $service->image_url,
                    'delay' => ($index + 1) * 100
                ];
            })->toArray();
        }else{
            return Service::where('status', 'active')->orderBy('created_at', 'desc')->get()->map(function ($service, $index) {
                return [
                    'id' => $service->id,
                    'icon' => $service->icon,
                    'title' => $service->en_name,
                    'description' => $service->en_description,
                    'image' => $service->image_url,
                    'delay' => ($index + 1) * 100
                ];
            })->toArray();
        }
    }

    private function getStats()
    {
        return [
            [
                'value' => '500+',
                'label' => 'Clients Served',
            ],
            [
                'value' => '1000+',
                'label' => 'Projects Completed',
            ],
            [
                'value' => '50+',
                'label' => 'Team Members',
            ],
            [
                'value' => '15+',
                'label' => 'Years Experience',
            ]
        ];
    }

    private function getFeatures()
    {
        return [
            [
                'icon' => 'fas fa-rocket',
                'title' => 'Fast Delivery',
                'description' => 'Quick turnaround times without compromising quality.'
            ],
            [
                'icon' => 'fas fa-shield-alt',
                'title' => 'Secure Solutions',
                'description' => 'Your data security is our top priority.'
            ],
            [
                'icon' => 'fas fa-headset',
                'title' => '24/7 Support',
                'description' => 'Round-the-clock assistance for your needs.'
            ]
        ];
    }
}
