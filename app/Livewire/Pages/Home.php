<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Service;

class Home extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'message' => 'required|min:10',
    ];

    public function mount()
    {
        // Initialize any data if needed
    }

    public function render()
    {
        return view('livewire.pages.home', [
            'services' => $this->getServices(),
            'stats' => $this->getStats(),
            'features' => $this->getFeatures(),
        ])->layout('layouts.app');
    }

    public function submitContact()
    {
        $this->validate();

        // Here you would typically send an email or save to database
        session()->flash('message', 'Thank you for your message. We\'ll get back to you soon!');

        $this->reset(['name', 'email', 'message']);
    }

    private function getServices()
    {
        return Service::where('status', 'active')->get()->map(function ($service, $index) {
            return [
                'id' => $service->id,
                'icon' => $service->icon,
                'title' => $service->name,
                'description' => $service->description,
                'image' => $service->image_url,
                'delay' => ($index + 1) * 100
            ];
        })->toArray();
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
