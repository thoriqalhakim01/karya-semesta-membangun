<?php
namespace App\Livewire\Admin\Programs;

use App\Models\Program;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowProgram extends Component
{
    public $program;

    public $numberOfParticipants = 0;

    public function mount(Program $program)
    {
        $this->program = $program;

        $this->numberOfParticipants = $program->users->count();
    }

    #[On('program-updated')]
    public function refreshProgram()
    {
        $this->program->refresh();
    }

    public function delete(Program $program)
    {
        $program->delete();

        $this->redirect(route('admin.programs.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.programs.show-program');
    }
}
