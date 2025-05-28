<?php
namespace App\Livewire\Forms\Admin\Programs;

use App\Models\Program;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateProgramForm extends Form
{
    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('nullable|string|max:255')]
    public $description = '';

    #[Validate('required|numeric|min:0')]
    public $target = 0;

    public function store(): bool
    {
        $this->validate();

        Program::create([
            'name'        => $this->name,
            'description' => $this->description,
            'target'      => $this->target,
        ]);

        $this->reset();

        return true;
    }
}
