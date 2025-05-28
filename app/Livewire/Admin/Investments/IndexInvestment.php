<?php
namespace App\Livewire\Admin\Investments;

use App\Models\Investment;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class IndexInvestment extends Component
{
    use WithPagination;

    #[Url( as :'q')]
    public $search;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function getInvestmentsProperty()
    {
        $query = Investment::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })->orderBy('created_at', 'desc');

        return $query->paginate(12);
    }

    public function render()
    {
        return view('livewire.admin.investments.index-investment', [
            'investments' => $this->investments,
        ]);
    }
}
