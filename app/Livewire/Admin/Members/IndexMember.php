<?php
namespace App\Livewire\Admin\Members;

use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class IndexMember extends Component
{
    use WithPagination;

    #[Url( as :'q')]
    public $search;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function getMembersProperty()
    {
        $query = User::query()->with('detail')->role('user')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                ;
            })->orderBy('created_at', 'desc');

        return $query->paginate(12);
    }

    public function render()
    {
        return view('livewire.admin.members.index-member', [
            'members' => $this->members,
        ]);
    }
}
