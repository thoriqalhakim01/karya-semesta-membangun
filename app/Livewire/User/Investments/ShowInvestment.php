<?php
namespace App\Livewire\User\Investments;

use App\Models\Investment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowInvestment extends Component
{
    public Investment $investment;

    public $collected = 0;

    public function mount(Investment $investment)
    {
        $this->investment = $investment;

        $this->collected = $this->investment->transactions()
            ->where('user_id', Auth::user()->id)
            ->sum('amount');
    }

    public function getTransactionsProperty()
    {
        return $this->investment->transactions()
            ->where('user_id', Auth::user()->id)
            ->with('user')
            ->latest()
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.user.investments.show-investment', [
            'transactions' => $this->transactions,
        ]);
    }
}
