<?php

namespace App\Livewire\Forms\Admin\Members;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditMemberInvestmentForm extends Form
{
    public $investments = [];

    public function setInvestments($investments)
    {
        if ($investments) {
            $this->investments = $investments;
        }
    }

    public function update($id)
    {
        $member = User::findOrFail($id);

        $member->investments()->sync($this->investments);
    }
}
