<?php
namespace App\Livewire\Forms\Admin\Members;

use App\Models\Transaction;
use App\Models\User;
use App\Models\UserProgram;
use Illuminate\Support\Facades\DB;
use Livewire\Form;

class EditMemberProgramForm extends Form
{
    public $programs = [];

    public $beforeUpdate = [];

    public function setPrograms($programs)
    {
        if ($programs) {
            $this->programs     = $programs;
            $this->beforeUpdate = $programs;
        }
    }

    public function update($id)
    {
        DB::beginTransaction();

        try {
            $member = User::findOrFail($id);

            $removedPrograms = array_diff($this->beforeUpdate, $this->programs);

            foreach ($removedPrograms as $program) {
                Transaction::where('user_id', $id)
                    ->where('transactionable_type', 'App\Models\Program')
                    ->where('transactionable_id', $program)
                    ->delete();
            }

            foreach ($this->programs as $program) {
                UserProgram::updateOrCreate([
                    'user_id'    => $id,
                    'program_id' => $program,
                ]);
            }

            $member->programs()->sync($this->programs);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
