<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Attributes\Layout;

#[Layout('layouts.auth')]
class Edit extends Component
{
    public $name;
    public $email;
    public $phone;
    public $address;
    public $country;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->country = $user->country;
    }

    public function render()
    {
        return view('livewire.profile.edit');
    }

    public function updateProfile()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'country' => ['nullable', 'string', 'max:100'],
        ]);

        $user = User::find(Auth::id());
        $user->fill($validated);
        $user->save();
        // arabic flash message depending on the language
        if (app()->getLocale() === 'ar') {
            session()->flash('status', 'تم تحديث الملف الشخصي بنجاح.');
        }else{
            session()->flash('status', 'Profile updated successfully.');
        }

        return redirect()->route('profile');
    }
}
