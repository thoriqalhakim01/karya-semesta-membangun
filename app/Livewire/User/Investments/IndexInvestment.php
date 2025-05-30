<?php

namespace App\Livewire\User\Investments;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IndexInvestment extends Component
{
    public function getInvestmentsProperty()
    {
        return auth()->user()->investments()->paginate(10);
    }

    public function render()
    {
        return view('livewire.user.investments.index-investment', [
            'investments' => $this->investments
        ]);
    }
}
