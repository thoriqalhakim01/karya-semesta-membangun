<?php

namespace App\Livewire\Forms\Admin\Members;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditMemberProgramForm extends Form
{
    public $programs = [];

    public function setPrograms($programs)
    {
        if ($programs) {
            $this->programs = $programs;
        }
    }

    public function update($id)
    {
        $member = User::findOrFail($id);

        $member->programs()->sync($this->programs);
    }
}
