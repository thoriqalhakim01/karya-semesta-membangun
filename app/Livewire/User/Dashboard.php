<?php
namespace App\Livewire\User;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $period = 'month';

    public User $user;

    public function mount()
    {
        $this->user = User::with(['programs', 'investments', 'transactions'])->find(Auth::user()->id);
    }

    public function getProgramFollowedProperty()
    {
        return $this->user->programs->count();
    }

    public function getTotalTransactionsProperty()
    {
        $date = Carbon::now();

        switch ($this->period) {
            case 'year':
                return Transaction::whereYear('transaction_date', date('Y'))
                    ->where('user_id', $this->user->id)
                    ->orderBy('transaction_date', 'desc')
                    ->count();
                break;
            case 'month':
                return Transaction::whereMonth('transaction_date', date('m'))
                    ->where('user_id', $this->user->id)
                    ->whereYear('transaction_date', date('Y'))
                    ->orderBy('transaction_date', 'desc')
                    ->count();
                break;
            case 'week':
                return Transaction::whereBetween('transaction_date', [$date->startOfWeek(), $date->endOfWeek()])
                    ->where('user_id', $this->user->id)
                    ->orderBy('transaction_date', 'desc')
                    ->count();
                break;
        }
    }

    public function getInvestmentValueProperty()
    {
        return Transaction::with(['transactionable'])
            ->where('user_id', $this->user->id)
            ->where('transactionable_type', 'App\Models\Investment')
            ->sum('amount');

    }

    public function getTransactionsProperty()
    {
        return Transaction::with(['transactionable'])
            ->where('user_id', $this->user->id)
            ->orderBy('transaction_date', 'desc')
            ->limit(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.user.dashboard', [
            'totalTransactions' => $this->totalTransactions,
            'programFollowed'   => $this->programFollowed,
            'investmentValue'   => $this->investmentValue,
            'transactions'      => $this->transactions,
        ]);
    }
}
