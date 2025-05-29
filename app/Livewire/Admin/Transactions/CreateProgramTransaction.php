<?php
namespace App\Livewire\Admin\Transactions;

use App\Livewire\Forms\Admin\Transactions\CreateProgramTransactionForm;
use App\Models\User;
use Livewire\Component;

class CreateProgramTransaction extends Component
{
    public CreateProgramTransactionForm $form;

    public $userPrograms = [];

    public function addTransactionRow()
    {
        $this->form->data['transactions'][] = [
            'date'    => '',
            'user'    => '',
            'program' => '',
            'type'    => '',
            'amount'  => '',
            'payment' => '',
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
                $this->userPrograms[$transactionIndex] = $user->programs()->get();
            } else {
                $this->userPrograms[$transactionIndex] = [];
            }

            $this->form->data['transactions'][$transactionIndex]['program'] = '';
        }
    }

    public function removeTransactionRow($index)
    {
        unset($this->form->data['transactions'][$index]);
        unset($this->userPrograms[$index]);

        $this->form->data['transactions'] = array_values($this->form->data['transactions']);

        $this->userPrograms = array_values($this->userPrograms);
    }

    public function save()
    {
        $this->form->store();

        $this->redirect(route('admin.transactions.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.transactions.create-program-transaction', [
            'users' => User::role('user')->get(),
        ]);
    }
}
