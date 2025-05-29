<?php
namespace App\Livewire\Admin\Members;

use App\Livewire\Forms\Admin\Members\EditMemberProgramForm;
use App\Models\Program;
use App\Models\User;
use Livewire\Component;

class EditMemberPrograms extends Component
{
    public EditMemberProgramForm $form;

    public $member;

    public $programList = [];

    public function mount(User $member)
    {
        $this->member = $member;

        $this->programList = Program::select('id', 'name')->get();

        $programs = $member->programs()->get()->pluck('id')->toArray();

        $this->form->setPrograms($programs);
    }

    public function addProgramRow()
    {
        $this->form->programs[] = '';
    }

    public function removeProgramRow($index)
    {
        if (count($this->form->programs) > 1) {
            unset($this->form->programs[$index]);
            $this->form->programs = array_values($this->form->programs);
        }
    }

    public function save()
    {
        $this->form->update($this->member->id);

        $this->redirect(route('admin.members.show', $this->member));
    }

    public function render()
    {
        return view('livewire.admin.members.edit-member-programs');
    }
}
