<?php

namespace App\Livewire\Admin\Members;

use App\Livewire\Forms\Admin\Members\EditMemberInvestmentForm;
use App\Models\Investment;
use App\Models\User;
use Livewire\Component;

class EditMemberInvestments extends Component
{
    public EditMemberInvestmentForm $form;

    public $member;

    public $investmentList = [];

    public function mount(User $member)
    {
        $this->member = $member;

        $this->investmentList = Investment::select('id', 'name')->get();

        $investments = $member->investments()->get()->pluck('id')->toArray();

        $this->form->setInvestments($investments);
    }

    public function addInvestmentRow()
    {
        $this->form->investments[] = '';
    }

    public function removeInvestmentRow($index)
    {
        if (count($this->form->investments) > 1) {
            unset($this->form->investments[$index]);
            $this->form->investments = array_values($this->form->investments);
        }
    }

    public function save()
    {
        $this->form->update($this->member->id);

        $this->redirect(route('admin.members.show', $this->member));
    }

    public function render()
    {
        return view('livewire.admin.members.edit-member-investments');
    }
}
