<?php
namespace App\Livewire\Admin\Programs;

use App\Livewire\Forms\Admin\Programs\CreateProgramForm;
use Livewire\Component;

class CreateProgram extends Component
{
    public CreateProgramForm $form;

    public function save(): void
    {
        $this->form->store();

        $this->modal('create-program')->close();
    }

    public function render()
    {
        return view('livewire.admin.programs.create-program');
    }
}
