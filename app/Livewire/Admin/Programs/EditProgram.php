<?php
namespace App\Livewire\Admin\Programs;

use App\Livewire\Forms\Admin\Programs\EditProgramForm;
use App\Models\Program;
use Livewire\Component;

class EditProgram extends Component
{
    public Program $program;
    public EditProgramForm $form;

    public function mount(Program $program)
    {
        $this->program = $program;

        $this->form->setProgram($program);
    }

    public function save()
    {
        $this->form->update($this->program->id);

        $this->dispatch('program-updated');
        
        $this->modal('edit-program')->close();
    }

    public function render()
    {
        return view('livewire.admin.programs.edit-program');
    }
}
