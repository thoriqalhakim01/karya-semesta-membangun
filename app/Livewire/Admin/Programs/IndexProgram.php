<?php
namespace App\Livewire\Admin\Programs;

use App\Models\Program;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class IndexProgram extends Component
{

    use WithPagination;

    #[Url( as :'q')]
    public $search;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function getProgramsProperty()
    {
        $query = Program::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })->orderBy('created_at', 'desc');

        return $query->paginate(12);
    }

    public function render()
    {
        return view('livewire.admin.programs.index-program', [
            'programs' => $this->programs,
        ]);
    }
}
