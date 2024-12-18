<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.auth')]
class Show extends Component
{
    public function render()
    {
        return view('livewire.profile.show');
    }
}
