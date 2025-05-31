<?php
namespace App\Livewire\Settings\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditUserAddress extends Component
{
    public User $user;

    public $type        = '';
    public $fullAddress = '';

    public function mount()
    {
        $this->user = Auth::user();

        $this->type        = $this->user->address->address_type;
        $this->fullAddress = $this->user->address->full_address;
    }

    public function save()
    {
        $validated = $this->validate([
            'type'        => 'required|string|in:home,ktp,domicile',
            'fullAddress' => 'required|max:255',
        ]);

        $this->user->address()->update([
            'address_type' => $validated['type'],
            'full_address' => $validated['fullAddress'],
        ]);

        $this->dispatch('userAddressUpdated');

        $this->modal('edit-user-address')->close();
    }

    public function render()
    {
        return view('livewire.settings.profile.edit-user-address');
    }
}
