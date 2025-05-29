<?php
namespace App\Livewire\Forms\Admin\Members;

use App\Models\User;
use App\Models\UserProgram;
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

        foreach ($this->programs as $program) {
            UserProgram::updateOrCreate([
                'user_id'    => $id,
                'program_id' => $program,
            ]);
        }

        $member->programs()->sync($this->programs);
    }
}
