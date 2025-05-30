<?php
namespace App\Livewire\User\Programs;

use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowProgram extends Component
{
    public Program $program;

    public $collected = 0;

    public $difference = 0;

    public function mount(Program $program)
    {
        $this->program = $program;

        $this->collected = $this->program->transactions()
            ->where('user_id', Auth::user()->id)
            ->sum('amount');

        $this->difference = $this->collected - $this->program->target;
    }

    public function getTransactionsProperty()
    {
        return $this->program->transactions()
            ->where('user_id', Auth::user()->id)
            ->with('user')
            ->latest()
            ->paginate(10);
    }

    public function getDifferenceFormattedProperty()
    {
        $prefix = $this->difference >= 0 ? '+ ' . $this->difference : '- ' . abs($this->difference);
        return $prefix;
    }

    public function render()
    {
        return view('livewire.user.programs.show-program', [
            'transactions' => $this->transactions,
        ]);
    }
}
