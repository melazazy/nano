<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ManageUsers extends Component
{
    public $users;
    public $showModal = false; // Modal visibility
    public $editUser; // User being edited
    public $name, $email, $password, $password_confirmation, $role; // Registration fields

    public function mount()
    {
        $this->users = User::orderBy('created_at', 'desc')->where('is_admin', 0)->get();
    }
    public function register()
{
    $validatedData = $this->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        'role' => 'required|in:admin,user', // Add role validation
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);
    $validatedData['is_admin'] = $validatedData['role'] === 'admin'; // Assuming you have an is_admin column

    User::create($validatedData);
    if(app()->getLocale() == 'ar'){
        session()->flash('success', 'تم تسجيل المستخدم بنجاح.');
    }else{
        session()->flash('success', 'User registered successfully.');
    }
    $this->reset(); // Reset form fields
    $this->users = User::all(); // Refresh user list
}
    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        if (Auth::user()->is_admin) {
            $this->editUser = $user->toArray();
            $this->showModal = true;
        } else {
            if(app()->getLocale() == 'ar'){
                session()->flash('error', 'لا يمكنك تحديث المستخدم.');
            }else{
                session()->flash('error', 'You are not authorized to edit this user.');
            }
        }
    }

    public function save()
    {
        // Validate and save the changes
        $rules = [
            'editUser.name' => 'required|string|max:255',
            'editUser.email' => 'required|email|max:255',
        ];
        $this->validate($rules);
        User::find($this->editUser['id'])->update($this->editUser);
        $this->showModal = false;
        if(app()->getLocale() == 'ar'){
            session()->flash('success', 'تم تحديث المستخدم بنجاح.');
        }else{
            session()->flash('success', 'User updated successfully.');
        }
    }
    public function delete($userId)
{
    $user = User::findOrFail($userId);
    if (Auth::user()->is_admin) {
        $user->delete();
        if(app()->getLocale() == 'ar'){
            session()->flash('success', 'تم حذف المستخدم بنجاح.');
        }else{
            session()->flash('success', 'User deleted successfully.');
        }
        $this->mount(); // Refresh the user list
    } else {
        if(app()->getLocale() == 'ar'){
            session()->flash('error', 'لا يمكنك حذف المستخدم.');
        }else{
        session()->flash('error', 'You are not authorized to delete this user.');
        }
    }
    
}

    public function render()
    {
        return view('livewire.manage-users')->layout('layouts.volt');
    }
}