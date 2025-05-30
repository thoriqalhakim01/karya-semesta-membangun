<?php
namespace App\Livewire\Admin\Transactions;

use App\Models\Transaction;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class IndexTransaction extends Component
{
    use WithPagination;

    #[Url( as :'q', keep: true)]
    public $search = '';

    #[Url( as :'type', keep: true)]
    public $transactionableType = '';

    #[Url( as :'start', keep: true)]
    public $startDate = '';

    #[Url( as :'end', keep: true)]
    public $endDate = '';

    #[Url( as :'program_type', keep: true)]
    public $programType = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedTransactionableType()
    {
        $this->programType = '';
        $this->resetPage();
    }

    public function updatedStartDate()
    {
        $this->resetPage();
    }

    public function updatedEndDate()
    {
        $this->resetPage();
    }

    public function updatedProgramType()
    {
        $this->resetPage();
    }

    public function getTransactionsProperty()
    {
        return $this->fetchTransactions();
    }

    private function fetchTransactions()
    {
        $query = Transaction::query()->with(['user', 'transactionable']);

        if (! empty($this->transactionableType)) {
            if ($this->transactionableType === 'program') {
                $query->where('transactionable_type', 'App\Models\Program');
            } elseif ($this->transactionableType === 'investment') {
                $query->where('transactionable_type', 'App\Models\Investment');
            }
        }

        if (! empty($this->search)) {
            $searchTerm = trim($this->search);
            $query->where(function ($subQuery) use ($searchTerm) {
                $subQuery->whereHas('user', function ($userQuery) use ($searchTerm) {
                    $userQuery->where('name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('email', 'like', '%' . $searchTerm . '%');
                })
                    ->orWhereHas('transactionable', function ($transactionableQuery) use ($searchTerm) {
                        $transactionableQuery->where('name', 'like', '%' . $searchTerm . '%');
                    })
                    ->orWhere('transaction_type', 'like', '%' . $searchTerm . '%');
            });
        }

        if (! empty($this->startDate) && ! empty($this->endDate)) {
            $query->whereBetween('transaction_date', [$this->startDate, $this->endDate]);
        }

        if (! empty($this->programType)) {
            $query->where('transaction_type', $this->programType)
                ->where('transactionable_type', 'App\Models\Program');
        }

        return $query->orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(12);
    }

    public function resetFilters()
    {
        $this->reset(['search', 'transactionableType', 'startDate', 'endDate', 'programType']);
        $this->resetPage();
    }

    public function delete($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        $this->dispatch('$refresh');
    }

    public function render()
    {
        return view('livewire.admin.transactions.index-transaction', [
            'transactions' => $this->transactions,
        ]);
    }
}
