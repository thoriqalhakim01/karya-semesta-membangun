<?php
namespace App\Livewire\Forms\Admin\Members;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditMemberForm extends Form
{
    #[Validate('required|string|max:255')]
    public $name;
    #[Validate('required|email|max:255')]
    public $email;
    #[Validate('required|string|max:255')]
    public $phone;
    #[Validate('nullable|string|max:255')]
    public $birthOfPlace;
    #[Validate('nullable|date')]
    public $birthOfDate;
    #[Validate('nullable|string|in:male,female')]
    public $gender;
    #[Validate('nullable|boolean')]
    public $married;
    #[Validate('nullable|string|max:255')]
    public $lastEducation;
    #[Validate('nullable|string|max:255')]
    public $major;
    #[Validate('nullable|string|max:255')]
    public $job;

    public function setMember(User $member)
    {
        if ($member) {
            $this->name          = $member->name;
            $this->email         = $member->email;
            $this->phone         = $member->phone;
            $this->birthOfPlace  = $member->detail->birth_place;
            $this->birthOfDate   = $member->detail->birth_date;
            $this->gender        = $member->detail->gender;
            $this->married       = $member->detail->married;
            $this->lastEducation = $member->detail->last_education;
            $this->major         = $member->detail->major;
            $this->job           = $member->detail->job;
        }
    }

    public function update($member)
    {
        $member = User::findOrFail($member);

        $member->update([
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        $member->detail->update([
            'birth_place'    => $this->birthOfPlace,
            'birth_date'     => $this->birthOfDate,
            'gender'         => $this->gender,
            'is_married'     => $this->married,
            'last_education' => $this->lastEducation,
            'major'          => $this->major,
            'job'            => $this->job,
        ]);
    }
}
