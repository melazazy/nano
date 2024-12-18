<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AuthNavigation extends Component
{
    public function render()
    {
        return view('livewire.layout.auth-navigation');
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        
        return redirect()->route('home');
    }
}