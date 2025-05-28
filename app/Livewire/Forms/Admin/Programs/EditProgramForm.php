<?php
namespace App\Livewire\Forms\Admin\Programs;

use App\Models\Program;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditProgramForm extends Form
{
    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|string')]
    public $description = '';

    #[Validate('required|numeric|min:0')]
    public $target = 0;

    public function setProgram(Program $program): void
    {
        if ($program) {
            $this->name        = $program->name;
            $this->description = $program->description;
            $this->target      = $program->target;
        }
    }

    public function update($id): bool
    {
        $this->validate();

        $program = Program::findOrFail($id);

        $program->update([
            'name'        => $this->name,
            'description' => $this->description,
            'target'      => $this->target,
        ]);

        $this->reset();

        return true;
    }
}
