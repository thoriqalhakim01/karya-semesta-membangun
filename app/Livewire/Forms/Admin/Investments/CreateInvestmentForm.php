<?php
namespace App\Livewire\Forms\Admin\Investments;

use App\Models\Investment;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateInvestmentForm extends Form
{
    #[Validate('required|string|max:255')]
    public $name = '';

    public function store(): bool
    {
        $this->validate();

        Investment::create([
            'name' => $this->name,
        ]);

        $this->reset();

        return true;
    }
}
