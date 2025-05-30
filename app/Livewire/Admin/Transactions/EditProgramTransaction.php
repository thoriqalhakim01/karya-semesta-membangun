<?php
namespace App\Livewire\Admin\Transactions;

use App\Livewire\Forms\Admin\Transactions\EditProgramTransactionForm;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class EditProgramTransaction extends Component
{
    public EditProgramTransactionForm $form;

    public $id;
    public $userPrograms = [];

    public function mount($id)
    {
        $transactions = Transaction::findOrFail($id);

        $this->form->setTransaction($transactions);

        $this->id = $transactions->id;

        $this->userPrograms = $transactions->user->programs()->get();
    }

    public function updated($property)
    {
        if ($property === 'form.user') {
            $user = User::find($this->form->user);

            $this->form->program = '';

            $this->userPrograms = $user ? $user->programs()->get() : collect();
        }
    }

    public function save()
    {
        $this->form->update($this->id);

        $this->redirect(route('admin.transactions.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.transactions.edit-program-transaction', [
            'users' => User::role('user')->get(),
        ]);
    }
}
