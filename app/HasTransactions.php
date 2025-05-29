<?php

namespace App;

use App\Models\Transaction;

trait HasTransactions
{
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }

    public function createTransaction(array $attributes)
    {
        return $this->transactions()->create($attributes);
    }

    public function totalTransactionAmount()
    {
        return $this->transactions()->sum('amount');
    }
}
