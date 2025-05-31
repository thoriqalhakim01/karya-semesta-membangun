<?php
namespace App\Livewire\Admin\Members;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class EditMemberPassword extends Component
{
    public $member;

    public string $password              = '';
    public string $password_confirmation = '';

    public function mount(User $member)
    {
        $this->member = $member;
    }

    public function save()
    {
        $this->validate([
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
        ]);

        $this->member->update([
            'password' => Hash::make($this->password),
        ]);

        $this->redirect(route('admin.members.show', $this->member));
    }

    public function render()
    {
        return view('livewire.admin.members.edit-member-password');
    }
}
