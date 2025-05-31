<?php
namespace App\Livewire\Settings\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserAddress extends Component
{
    public User $user;

    public $type        = '';
    public $fullAddress = '';

    protected $listeners = ['userAddressUpdated' => 'refreshUser'];

    public function mount()
    {
        $this->user = Auth::user();

        if ($this->user->address) {
            $this->type        = $this->user->address->address_type;
            $this->fullAddress = $this->user->address->full_address;
        }
    }

    public function refreshUser()
    {
        $this->user->refresh();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.settings.profile.user-address');
    }
}
