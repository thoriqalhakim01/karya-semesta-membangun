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

    public $showDetail      = false;
    public $showBankAccount = false;
    public $showAddress     = false;
    public $showFamily      = false;

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

    public function setShowDetail()
    {
        if ($this->showDetail) {
            $this->showDetail = false;
        } else {
            $this->showDetail = true;
        }
    }

    public function setShowBankAccount()
    {
        if ($this->showBankAccount) {
            $this->showBankAccount = false;
        } else {
            $this->showBankAccount = true;
        }
    }

    public function setShowAddress()
    {
        if ($this->showAddress) {
            $this->showAddress = false;
        } else {
            $this->showAddress = true;
        }
    }

    public function setShowFamily()
    {
        if ($this->showFamily) {
            $this->showFamily = false;
        } else {
            $this->showFamily = true;
        }
    }

    public function getCollectedAmountInvestment($investment)
    {
        return $investment->transactions()
            ->where('user_id', $this->member->id)
            ->sum('amount');
    }

    public function delete(User $member)
    {
        $member->delete();

        $this->redirect(route('admin.members.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.members.show-member');
    }
}
