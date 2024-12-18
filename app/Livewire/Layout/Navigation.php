<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Navigation extends Component
{
    public $currentLocale;
    public $availableLocales;

    public function mount()
    {
        $this->currentLocale = app()->getLocale();
        $this->availableLocales = LaravelLocalization::getSupportedLocales();
    }

    public function render()
    {
        return view('livewire.layout.navigation', [
            'isScrolled' => false
        ]);
    }
}
