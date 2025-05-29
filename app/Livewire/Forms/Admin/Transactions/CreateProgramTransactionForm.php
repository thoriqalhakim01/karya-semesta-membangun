<?php
namespace App\Livewire\Forms\Admin\Transactions;

use App\Models\Transaction;
use Livewire\Form;

class CreateProgramTransactionForm extends Form
{
    public $data = [
        'transactions' => [
            [
                'date'    => '',
                'user'    => '',
                'program' => '',
                'type'    => '',
                'amount'  => '',
                'payment' => '',
            ],
        ],
    ];

    protected function rules(): array
    {
        return [
            'data.transactions.*.date'    => 'required|date',
            'data.transactions.*.user'    => 'required|exists:users,id',
            'data.transactions.*.program' => 'required|exists:programs,id',
            'data.transactions.*.type'    => 'required|string|in:loyalty,personal',
            'data.transactions.*.amount'  => 'required|numeric',
            'data.transactions.*.payment' => 'required|string',
        ];
    }

    protected function messages(): array
    {
        return [
            'data.transactions.*.date.required'    => 'Transaction date is required.',
            'data.transactions.*.date.date'        => 'Transaction date is invalid.',
            'data.transactions.*.user.required'    => 'User is required.',
            'data.transactions.*.user.exists'      => 'User not found.',
            'data.transactions.*.program.required' => 'Program is required.',
            'data.transactions.*.program.exists'   => 'Program not found.',
            'data.transactions.*.type.required'    => 'Transaction type is required.',
            'data.transactions.*.type.in'          => 'Transaction type is invalid.',
            'data.transactions.*.amount.required'  => 'Transaction amount is required.',
            'data.transactions.*.amount.numeric'   => 'Transaction amount must be a number.',
            'data.transactions.*.payment.required' => 'Payment method is required.',
        ];
    }

    public function store()
    {
        try {
            $this->validate();

            foreach ($this->data['transactions'] as $item) {
                Transaction::create([
                    'user_id'              => $item['user'],
                    'transactionable_id'   => $item['program'],
                    'transactionable_type' => 'App\Models\Program',
                    'transaction_date'     => $item['date'],
                    'transaction_type'     => $item['type'],
                    'amount'               => $item['amount'],
                    'payment_method'       => $item['payment'],
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
