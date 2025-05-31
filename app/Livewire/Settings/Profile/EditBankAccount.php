<?php
namespace App\Livewire\Settings\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditBankAccount extends Component
{
    public User $user;

    public $btnAccountNumber;
    public $mandiriAccountNumber;

    public function mount()
    {
        $this->user = Auth::user();

        $this->btnAccountNumber     = $this->user->detail->btn_account_number;
        $this->mandiriAccountNumber = $this->user->detail->mandiri_account_number;
    }

    public function save()
    {
        $validated = $this->validate([
            'btnAccountNumber'     => 'nullable|string|max:255',
            'mandiriAccountNumber' => 'nullable|string|max:255',
        ]);

        $this->user->detail->update([
            'btn_account_number'     => $validated['btnAccountNumber'],
            'mandiri_account_number' => $validated['mandiriAccountNumber'],
        ]);

        $this->dispatch('bankAccountUpdated');

        $this->modal('edit-bank-account')->close();
    }

    public function render()
    {
        return view('livewire.settings.profile.edit-bank-account');
    }
}
