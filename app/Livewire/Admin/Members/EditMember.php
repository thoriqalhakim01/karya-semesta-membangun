<?php
namespace App\Livewire\Admin\Members;

use App\Livewire\Forms\Admin\Members\EditMemberForm;
use App\Models\User;
use Livewire\Component;

class EditMember extends Component
{
    public EditMemberForm $form;

    public $member;

    public function mount(User $member)
    {
        $this->member = $member;

        $this->form->setMember($this->member);
        $this->form->setMemberAddress($this->member->address()->first());
        $this->form->setMemberFamily($this->member->family()->first());
    }

    public function save()
    {
        $this->form->update($this->member->id);

        $this->redirect(route('admin.members.show', $this->member));
    }

    public function render()
    {
        return view('livewire.admin.members.edit-member');
    }
}
