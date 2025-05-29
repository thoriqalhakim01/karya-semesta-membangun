<?php
namespace App\Livewire\Admin\Transactions;

use App\Models\Transaction;
use Livewire\Component;

class ShowTransaction extends Component
{
    public $transaction;
    public $showModal = false;

    public function mount(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.admin.transactions.show-transaction');
    }
}
