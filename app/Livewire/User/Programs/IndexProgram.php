<?php

namespace App\Livewire\User\Programs;

use Livewire\Component;

class IndexProgram extends Component
{
    public function getProgramsProperty()
    {
        return auth()->user()->programs()->paginate(10);
    }

    public function render()
    {
        return view('livewire.user.programs.index-program', [
            'programs' => $this->programs
        ]);
    }
}
