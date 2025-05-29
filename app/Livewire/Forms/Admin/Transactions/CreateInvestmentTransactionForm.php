<?php
namespace App\Livewire\Forms\Admin\Transactions;

use App\Models\Transaction;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateInvestmentTransactionForm extends Form
{
    public $data = [
        'transactions' => [
            [
                'date'       => '',
                'user'       => '',
                'investment' => '',
                'amount'     => '',
                'payment'    => '',
            ],
        ],
    ];

    protected function rules(): array
    {
        return [
            'data.transactions.*.date'       => 'required|date',
            'data.transactions.*.user'       => 'required|exists:users,id',
            'data.transactions.*.investment' => 'required|exists:investments,id',
            'data.transactions.*.amount'     => 'required|numeric',
            'data.transactions.*.payment'    => 'required|string',
        ];
    }

    protected function messages(): array
    {
        return [
            'data.transactions.*.date.required'       => 'Transaction date is required.',
            'data.transactions.*.date.date'           => 'Transaction date is invalid.',
            'data.transactions.*.user.required'       => 'User is required.',
            'data.transactions.*.user.exists'         => 'User not found.',
            'data.transactions.*.investment.required' => 'Investment type is required.',
            'data.transactions.*.investment.exists'   => 'Investment type not found.',
            'data.transactions.*.amount.required'     => 'Transaction amount is required.',
            'data.transactions.*.amount.numeric'      => 'Transaction amount must be a number.',
            'data.transactions.*.payment.required'    => 'Payment method is required.',
        ];
    }

    public function store()
    {
        try {
            $this->validate();

            foreach ($this->data['transactions'] as $item) {
                Transaction::create([
                    'user_id'              => $item['user'],
                    'transactionable_id'   => $item['investment'],
                    'transactionable_type' => 'App\Models\Investment',
                    'transaction_date'     => $item['date'],
                    'amount'               => $item['amount'],
                    'payment_method'       => $item['payment'],
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
