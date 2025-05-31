<?php
namespace App\Livewire\Settings\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BankAccount extends Component
{
    public User $user;

    protected $listeners = ['bankAccountUpdated' => 'refreshUser'];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function refreshUser()
    {
        $this->user->refresh();
    }

    public function render()
    {
        return view('livewire.settings.profile.bank-account');
    }
}
