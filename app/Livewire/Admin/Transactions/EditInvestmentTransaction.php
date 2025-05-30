<?php
namespace App\Livewire\Admin\Transactions;

use App\Livewire\Forms\Admin\Transactions\EditInvestmentTransactionForm;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class EditInvestmentTransaction extends Component
{
    public EditInvestmentTransactionForm $form;

    public $id;
    public $userInvestments = [];

    public function mount($id)
    {
        $transactions = Transaction::findOrFail($id);

        $this->form->setTransaction($transactions);

        $this->id = $transactions->id;

        $this->userInvestments = $transactions->user->investments()->get();
    }

    public function updated($property)
    {
        if ($property === 'form.user') {
            $user = User::find($this->form->user);

            $this->form->investment = '';

            $this->userInvestments = $user->investments()->get();
        }
    }

    public function save()
    {
        $this->form->update($this->form->user);

        $this->redirect(route('admin.transactions.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.transactions.edit-investment-transaction', [
            'users' => User::role('user')->get(),
        ]);
    }
}
