<?php
namespace App\Livewire\Admin\Transactions;

use App\Models\Transaction;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class IndexTransaction extends Component
{
    use WithPagination;

    #[Url( as :'q')]
    public $search = '';

    #[Url( as :'type')]
    public $transactionableType = '';

    #[Url( as :'start')]
    public $startDate = '';

    #[Url( as :'end')]
    public $endDate = '';

    #[Url( as :'program_type')]
    public $programType = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedTransactionableType()
    {
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
        $query = Transaction::query()
            ->with(['user', 'transactionable'])
            ->when($this->search, function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->transactionableType, function ($query) {
                if ($this->transactionableType === 'program') {
                    $query->where('transactionable_type', 'App\Models\Program');
                } elseif ($this->transactionableType === 'investment') {
                    $query->where('transactionable_type', 'App\Models\Investment');
                }
            })
            ->when($this->startDate && $this->endDate, function ($query) {
                $query->whereBetween('transaction_date', [$this->startDate, $this->endDate]);
            })
            ->when($this->programType && $this->transactionableType === 'program', function ($query) {
                $query->where('transaction_type', $this->programType);
            });

        return $query->orderBy('transaction_date', 'desc')->paginate(12);
    }

    public function resetFilters()
    {
        $this->search              = '';
        $this->transactionableType = '';
        $this->startDate           = '';
        $this->endDate             = '';
        $this->programType         = '';
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.transactions.index-transaction', [
            'transactions' => $this->transactions,
        ]);
    }
}
