<?php
namespace App\Livewire\Admin;

use App\Models\Investment;
use App\Models\Program;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{

    public $period = 'month';

    public function getTransactionsProperty()
    {
        return Transaction::with(['user', 'transactionable'])->orderBy('transaction_date', 'desc')->limit(10)->get();
    }

    public function totalTransactions()
    {
        $date = Carbon::now();

        switch ($this->period) {
            case 'year':
                return Transaction::whereYear('transaction_date', date('Y'))
                    ->orderBy('transaction_date', 'desc')
                    ->count();
                break;
            case 'month':
                return Transaction::whereMonth('transaction_date', date('m'))
                    ->whereYear('transaction_date', date('Y'))
                    ->orderBy('transaction_date', 'desc')
                    ->count();
                break;
            case 'week':
                return Transaction::whereBetween('transaction_date', [$date->startOfWeek(), $date->endOfWeek()])
                    ->orderBy('transaction_date', 'desc')
                    ->count();
                break;
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalMembers'      => User::role('user')->count(),
            'totalInvestments'  => Investment::count(),
            'totalPrograms'     => Program::count(),
            'transactions'      => $this->transactions,
            'totalTransactions' => $this->totalTransactions(),
        ]);
    }
}
