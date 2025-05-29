<?php
namespace App\Livewire\Admin\Investments;

use App\Models\Investment;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowInvestment extends Component
{
    public $investment;

    public $numberOfParticipants = 0;

    public function mount(Investment $investment)
    {
        $this->investment = $investment;

        $this->numberOfParticipants = $investment->users->count();
    }

    #[On('investment-updated')]
    public function refreshInvestment()
    {
        $this->investment->refresh();
    }

    public function delete(Investment $investment)
    {
        $investment->delete();

        $this->redirect(route('admin.investments.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.investments.show-investment');
    }
}
