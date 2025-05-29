<?php
namespace App\Livewire\Admin\Members;

use App\Models\User;
use Livewire\Component;

class EditMemberPrograms extends Component
{
    public $member;

    public function mount(User $member)
    {
        $this->member = $member;
    }

    public function render()
    {
        return view('livewire.admin.members.edit-member-programs');
    }
}
