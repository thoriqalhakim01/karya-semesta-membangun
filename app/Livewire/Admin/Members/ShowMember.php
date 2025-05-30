<?php
namespace App\Livewire\Admin\Members;

use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ShowMember extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $member;

    public function mount($member)
    {
        $this->member = User::with(['detail', 'investments', 'programs.transactions'])->findOrFail($member);
    }

    public function getCollectedAmountProgram($program)
    {
        return $program->transactions()
            ->where('user_id', $this->member->id)
            ->sum('amount');
    }

    public function getCollectedAmountInvestment($investment)
    {
        return $investment->transactions()
            ->where('user_id', $this->member->id)
            ->sum('amount');
    }

    public function getTransactionsProperty()
    {
        return $this->member->memberTransactions()
            ->with(['transactionable'])
            ->orderBy('transaction_date', 'desc')
            ->paginate(10);
    }

    public function delete(User $member)
    {
        $member->delete();

        $this->redirect(route('admin.members.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.members.show-member', [
            'transactions' => $this->transactions,
        ]);
    }
}
