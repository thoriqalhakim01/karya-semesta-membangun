<?php
namespace App\Livewire\Forms\Admin\Transactions;

use App\Models\Transaction;
use Livewire\Form;

class EditInvestmentTransactionForm extends Form
{
    public $date       = '';
    public $user       = '';
    public $investment = '';
    public $amount     = '';
    public $payment    = '';

    protected function rules(): array
    {
        return [
            'date'       => 'required|date',
            'user'       => 'required|exists:users,id',
            'investment' => 'nullable|exists:investments,id',
            'amount'     => 'required|numeric',
            'payment'    => 'required|string',
        ];
    }

    protected function messages(): array
    {
        return [
            'date.required'       => 'Transaction date is required.',
            'date.date'           => 'Transaction date format is invalid.',
            'user.required'       => 'User is required.',
            'user.exists'         => 'User not found.',
            'investment.required' => 'Investment is required.',
            'investment.exists'   => 'Investment not found.',
            'amount.required'     => 'Amount is required.',
            'amount.numeric'      => 'Amount must be a number.',
            'payment.required'    => 'Payment method is required.',
        ];
    }

    public function setTransaction($transaction): void
    {
        if ($transaction) {
            $this->date       = $transaction->transaction_date;
            $this->user       = $transaction->user_id;
            $this->investment = $transaction->transactionable_id;
            $this->amount     = $transaction->amount;
            $this->payment    = $transaction->payment_method;
        }
    }

    public function update($id)
    {
        $this->validate();

        $transaction = Transaction::findOrFail($id);

        $transaction->update([
            'transaction_date'   => $this->date,
            'user_id'            => $this->user,
            'transactionable_id' => $this->investment,
            'amount'             => $this->amount,
            'payment_method'     => $this->payment,
        ]);
    }
}
