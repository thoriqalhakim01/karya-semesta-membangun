<?php

namespace App\Livewire\Admin\Investments;

use App\Livewire\Forms\Admin\Investments\EditInvestmentForm;
use App\Models\Investment;
use Livewire\Component;

class EditInvestment extends Component
{
    public Investment $investment;
    public EditInvestmentForm $form;

    public function mount(Investment $investment)
    {
        $this->investment = $investment;

        $this->form->setInvestment($investment);
    }

    public function save()
    {
        $this->form->update($this->investment->id);

        $this->dispatch('investment-updated');

        $this->modal('edit-investment')->close();
    }

    public function render()
    {
        return view('livewire.admin.investments.edit-investment');
    }
}
