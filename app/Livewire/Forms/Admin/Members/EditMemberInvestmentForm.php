<?php
namespace App\Livewire\Forms\Admin\Members;

use App\Models\User;
use App\Models\UserInvestment;
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

        foreach ($this->investments as $investment) {
            UserInvestment::updateOrCreate([
                'user_id'       => $id,
                'investment_id' => $investment,
            ]);
        }

        $member->investments()->sync($this->investments);
    }
}
