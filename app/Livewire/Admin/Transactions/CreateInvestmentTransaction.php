<?php
namespace App\Livewire\Admin\Transactions;

use App\Livewire\Forms\Admin\Transactions\CreateInvestmentTransactionForm;
use App\Models\User;
use Livewire\Component;

class CreateInvestmentTransaction extends Component
{
    public CreateInvestmentTransactionForm $form;

    public $userInvestments = [];

    public function addTransactionRow()
    {
        $this->form->data['transactions'][] = [
            'date'       => '',
            'user'       => '',
            'investment' => '',
            'amount'     => '',
            'payment'    => '',
        ];
    }

    public function updatedForm($value, $index)
    {
        $key = explode('.', $index);

        $transactionIndex = $key[2] ?? null;

        if ($transactionIndex !== null && $key[3] === 'user') {
            $userId = $value;

            $user = User::find($userId);

            if ($user) {
                $this->userInvestments[$transactionIndex] = $user->investments()->get();
            } else {
                $this->userInvestments[$transactionIndex] = [];
            }

            $this->form->data['transactions'][$transactionIndex]['investment'] = '';
        }
    }

    public function removeTransactionRow($index)
    {
        unset($this->form->data['transactions'][$index]);
        unset($this->userInvestments[$index]);

        $this->form->data['transactions'] = array_values($this->form->data['transactions']);

        $this->userInvestments = array_values($this->userInvestments);
    }

    public function save()
    {
        $this->form->store();

        $this->redirect(route('admin.transactions.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.transactions.create-investment-transaction', [
            'users' => User::role('user')->get(),
        ]);
    }
}
