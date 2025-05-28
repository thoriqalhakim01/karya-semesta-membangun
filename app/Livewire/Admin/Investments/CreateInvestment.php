<?php
namespace App\Livewire\Admin\Investments;

use App\Livewire\Forms\Admin\Investments\CreateInvestmentForm;
use Livewire\Component;

class CreateInvestment extends Component
{
    public CreateInvestmentForm $form;

    public function save(): void
    {
        $this->form->store();

        $this->modal('create-investment')->close();
    }

    public function render()
    {
        return view('livewire.admin.investments.create-investment');
    }
}
