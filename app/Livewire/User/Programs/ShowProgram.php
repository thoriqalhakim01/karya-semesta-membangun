<?php
namespace App\Livewire\User\Programs;

use App\Models\Program;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ShowProgram extends Component
{
    use WithPagination, WithoutUrlPagination;

    public Program $program;

    public $collected = 0;

    public $difference = 0;

    #[Url( as :'year', keep: true)]
    public $selectedYear = '';

    #[Url( as :'month', keep: true)]
    public $selectedMonth = '';

    public function mount(Program $program)
    {
        $this->program = $program;

        if (empty($this->selectedYear)) {
            $this->selectedYear = now()->year;
        }

        $this->calculateStats();
    }

    public function updatedSelectedYear()
    {
        $this->selectedMonth = '';
        $this->resetPage();
        $this->calculateStats();
    }

    public function updatedSelectedMonth()
    {
        $this->resetPage();
        $this->calculateStats();
    }

    private function calculateStats()
    {
        $query = $this->program->transactions()
            ->where('user_id', Auth::user()->id)
            ->when($this->selectedYear, function ($query) {
                $query->whereYear('transaction_date', $this->selectedYear);
            })
            ->when($this->selectedMonth, function ($query) {
                $query->whereMonth('transaction_date', $this->selectedMonth);
            });

        $this->collected  = $query->sum('amount');
        $this->difference = $this->collected - $this->program->target;
    }

    public function getTransactionsProperty()
    {
        return $this->program->transactions()
            ->where('user_id', Auth::user()->id)
            ->with('user')
            ->when($this->selectedYear, function ($query) {
                $query->whereYear('transaction_date', $this->selectedYear);
            })
            ->when($this->selectedMonth, function ($query) {
                $query->whereMonth('transaction_date', $this->selectedMonth);
            })
            ->latest('transaction_date')
            ->latest('id')
            ->paginate(10);
    }

    public function getAvailableYearsProperty()
    {
        return $this->program->transactions()
            ->where('user_id', Auth::user()->id)
            ->selectRaw('YEAR(transaction_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();
    }

    public function getAvailableMonthsProperty()
    {
        if (! $this->selectedYear) {
            return [];
        }

        return $this->program->transactions()
            ->where('user_id', Auth::user()->id)
            ->whereYear('transaction_date', $this->selectedYear)
            ->selectRaw('MONTH(transaction_date) as month')
            ->distinct()
            ->orderBy('month', 'asc')
            ->pluck('month')
            ->map(function ($month) {
                return [
                    'value' => $month,
                    'label' => Carbon::create()->month($month)->translatedFormat('F'),
                ];
            })
            ->toArray();
    }

    public function resetFilters()
    {
        $this->selectedYear  = now()->year;
        $this->selectedMonth = '';
        $this->resetPage();
        $this->calculateStats();
    }

    public function getDifferenceFormattedProperty()
    {
        $prefix = $this->difference >= 0 ? '+ ' . $this->difference : '- ' . abs($this->difference);
        return $prefix;
    }

    public function render()
    {
        return view('livewire.user.programs.show-program', [
            'transactions'    => $this->transactions,
            'availableYears'  => $this->availableYears,
            'availableMonths' => $this->availableMonths,
        ]);
    }
}
