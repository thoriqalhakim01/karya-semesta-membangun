<?php
namespace App\Livewire\Admin\Investments;

use App\Models\Investment;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowInvestment extends Component
{
    public $investment;

    public $collected = 0;

    public $numberOfParticipants = 0;

    public function mount(Investment $investment)
    {
        $this->investment = $investment;

        $this->collected = $investment->totalTransactionAmount();

        $this->numberOfParticipants = $investment->users->count();
    }

    #[On('investment-updated')]
    public function refreshInvestment()
    {
        $this->investment->refresh();
    }

    public function getTransactionsProperty()
    {
        return $this->investment->transactions()
            ->with('user')
            ->latest()
            ->paginate(10);
    }

    public function delete(Investment $investment)
    {
        $investment->delete();

        $this->redirect(route('admin.investments.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.investments.show-investment', [
            'transactions' => $this->transactions,
        ]);
    }
}
