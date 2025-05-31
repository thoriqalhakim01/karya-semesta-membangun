<?php
namespace App\Livewire\Settings\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditUserDetail extends Component
{
    public User $user;

    public $birthOfPlace;
    public $birthOfDate;
    public $gender;
    public $married;
    public $lastEducation;
    public $major;
    public $job;

    public function mount()
    {
        $this->user = Auth::user();

        $this->birthOfPlace  = $this->user->detail->birth_place;
        $this->birthOfDate   = $this->user->detail->birth_date;
        $this->gender        = $this->user->detail->gender;
        $this->married       = $this->user->detail->is_married;
        $this->lastEducation = $this->user->detail->last_education;
        $this->major         = $this->user->detail->major;
        $this->job           = $this->user->detail->job;
    }

    public function save()
    {
        $validated = $this->validate([
            'birthOfPlace'  => 'nullable|string|max:255',
            'birthOfDate'   => 'required|date',
            'gender'        => 'required|in:male,female',
            'married'       => 'required|in:1,0',
            'lastEducation' => 'nullable|string|max:255',
            'major'         => 'nullable|string|max:255',
            'job'           => 'nullable|string|max:255',
        ]);

        $this->user->detail()->update([
            'birth_place'    => $validated['birthOfPlace'],
            'birth_date'     => $validated['birthOfDate'],
            'gender'         => $validated['gender'],
            'is_married'     => $validated['married'],
            'last_education' => $validated['lastEducation'],
            'major'          => $validated['major'],
            'job'            => $validated['job'],
        ]);

        $this->dispatch('userDetailUpdated');

        $this->modal('edit-user-detail')->close();
    }

    public function render()
    {
        return view('livewire.settings.profile.edit-user-detail');
    }
}
