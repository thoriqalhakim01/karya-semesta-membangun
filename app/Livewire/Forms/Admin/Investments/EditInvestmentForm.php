<?php
namespace App\Livewire\Forms\Admin\Investments;

use App\Models\Investment;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditInvestmentForm extends Form
{
    #[Validate('required|string|max:255')]
    public $name = '';

    public function setInvestment(Investment $investment): void
    {
        if ($investment) {
            $this->name = $investment->name;
        }
    }

    public function update($id): bool
    {
        $this->validate();

        $investment = Investment::findOrFail($id);

        $investment->update([
            'name' => $this->name,
        ]);

        $this->reset();

        return true;
    }
}
