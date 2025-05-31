<?php
namespace App\Livewire\Settings\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditUserFamily extends Component
{
    public User $user;

    public $fatherName = '';
    public $motherName = '';
    public $familyStatus = '';
    public $numberOfChildren = '';
    public $residentialOwnership = '';

    public function mount()
    {
        $this->user = Auth::user();

        $this->fatherName           = $this->user->family->father_name;
        $this->motherName           = $this->user->family->mother_name;
        $this->familyStatus         = $this->user->family->family_status;
        $this->numberOfChildren     = $this->user->family->number_of_children;
        $this->residentialOwnership = $this->user->family->residential_ownership;
    }

    public function save()
    {
        $validated = $this->validate([
            'fatherName'           => 'nullable|string|max:255',
            'motherName'           => 'nullable|string|max:255',
            'familyStatus'         => 'nullable|in:father,mother,child',
            'numberOfChildren'     => 'nullable|integer',
            'residentialOwnership' => 'nullable|in:rent,own',
        ]);

        $this->user->family()->update([
            'father_name'           => $validated['fatherName'],
            'mother_name'           => $validated['motherName'],
            'family_status'         => $validated['familyStatus'],
            'number_of_children'    => $validated['numberOfChildren'],
            'residential_ownership' => $validated['residentialOwnership'],
        ]);

        $this->dispatch('userFamilyUpdated');

        $this->modal('edit-user-family')->close();
    }

    public function render()
    {
        return view('livewire.settings.profile.edit-user-family');
    }
}
