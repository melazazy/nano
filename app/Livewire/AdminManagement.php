<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminManagement extends Component
{
    public $userId = null;
    public $name = '';
    public $email = '';
    public $phone = '';
    public $password = '';
    public $password_confirmation = '';
    public $role = 'admin';

    // New fields for edit
    public $address = '';
    public $city = '';
    public $country = '';
    public $postal_code = '';
    public $state = '';

    public function mount($id = null)
    {
        $this->role = 'admin';

        if ($id) {
            $this->userId = $id;
            $this->loadUser($id);
        }
    }

    public function loadUser($id)
    {
        $user = User::findOrFail($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->role = $user->is_admin ? 'admin' : 'user';

        // Load additional fields if they exist
        $this->address = $user->address ?? '';
        $this->city = $user->city ?? '';
        $this->country = $user->country ?? '';
        $this->postal_code = $user->postal_code ?? '';
        $this->state = $user->state ?? '';
    }

    public function createOrUpdateUser()
    {
        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,user',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'state' => 'nullable|string|max:100',
        ];

        // Add unique email validation, excluding current user if editing
        if ($this->userId) {
            $validationRules['email'] .= ',email,' . $this->userId;
        } else {
            $validationRules['email'] .= '|unique:users,email';
            $validationRules['password'] = ['required', 'string', 'confirmed', Rules\Password::defaults()];
        }

        $validatedData = $this->validate($validationRules);

        // Prepare data
        $userData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'is_admin' => $validatedData['role'] === 'admin',
            'address' => $validatedData['address'],
            'city' => $validatedData['city'],
            'country' => $validatedData['country'],
            'postal_code' => $validatedData['postal_code'],
            'state' => $validatedData['state'],
        ];

        // Add password only for new users
        if (!$this->userId) {
            $userData['password'] = Hash::make($validatedData['password']);
        }

        // Create or update user
        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $user->update($userData);
            $message = 'Admin updated successfully.';
        } else {
            User::create($userData);
            $message = 'Admin created successfully.';
        }
        if(app()->getLocale() == 'ar'){
            session()->flash('message', $message);
        }else{
            session()->flash('message', $message);
        }
        return redirect()->route('admin.management');
    }

    public function render()
    {
        return view('livewire.admin-management')->layout('layouts.volt');
    }
}
