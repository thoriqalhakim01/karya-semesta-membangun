<?php
namespace App\Livewire\Admin\Members;

use App\Models\User;
use Livewire\Component;

class ShowMember extends Component
{
    public $member;

    public function mount($member)
    {
        $this->member = User::with(['detail', 'investments', 'programs'])->findOrFail($member);
    }

    public function delete(User $member)
    {
        $member->delete();

        $this->redirect(route('admin.members.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.members.show-member');
    }
}
