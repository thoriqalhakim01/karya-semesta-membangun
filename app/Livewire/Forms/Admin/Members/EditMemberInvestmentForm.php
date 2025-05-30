<?php
namespace App\Livewire\Forms\Admin\Members;

use App\Models\Transaction;
use App\Models\User;
use App\Models\UserInvestment;
use Illuminate\Support\Facades\DB;
use Livewire\Form;

class EditMemberInvestmentForm extends Form
{
    public $investments = [];

    public $beforeUpdate = [];

    public function setInvestments($investments)
    {
        if ($investments) {
            $this->investments  = $investments;
            $this->beforeUpdate = $investments;
        }
    }

    public function update($id)
    {
        DB::beginTransaction();

        try {
            $member = User::findOrFail($id);

            $removedInvestments = array_diff($this->beforeUpdate, $this->investments);

            foreach ($removedInvestments as $investment) {
                Transaction::where('user_id', $id)
                    ->where('transactionable_type', 'App\Models\Investment')
                    ->where('transactionable_id', $investment)
                    ->delete();
            }

            foreach ($this->investments as $investment) {
                UserInvestment::updateOrCreate([
                    'user_id'       => $id,
                    'investment_id' => $investment,
                ]);
            }

            $member->investments()->sync($this->investments);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
