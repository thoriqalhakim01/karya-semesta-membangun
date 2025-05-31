<?php
namespace App\Livewire\Forms\Admin\Members;

use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserFamily;
use Illuminate\Support\Facades\DB;
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

    // Details
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

    // Bank Account
    #[Validate('nullable|string|max:255')]
    public $btn;
    #[Validate('nullable|string|max:255')]
    public $mandiri;

    // Address
    #[Validate('nullable|string|in:home,ktp,domicile')]
    public $addressType;
    #[Validate('nullable|max:255')]
    public $fullAddress;

    // Family
    #[Validate('nullable|string|max:255')]
    public $fatherName;
    #[Validate('nullable|string|max:255')]
    public $motherName;
    #[Validate('nullable|string|in:father,mother,child')]
    public $familyStatus;
    #[Validate('nullable|integer')]
    public $numberOfChildren;
    #[Validate('nullable|string|in:own,rent')]
    public $residentialOwnership;

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
            $this->btn           = $member->detail->btn_account_number;
            $this->mandiri       = $member->detail->mandiri_account_number;
        }
    }

    public function setMemberAddress(UserAddress $address)
    {
        if ($address) {
            $this->addressType = $address->address_type;
            $this->fullAddress = $address->full_address;
        }
    }

    public function setMemberFamily(UserFamily $family)
    {
        if ($family) {
            $this->fatherName           = $family->father_name;
            $this->motherName           = $family->mother_name;
            $this->familyStatus         = $family->family_status;
            $this->numberOfChildren     = $family->number_of_children;
            $this->residentialOwnership = $family->residential_ownership;
        }
    }

    public function update($member)
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $member = User::findOrFail($member);

            $member->update([
                'name'  => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);

            $member->detail->update([
                'birth_place'            => $this->birthOfPlace,
                'birth_date'             => $this->birthOfDate,
                'gender'                 => $this->gender,
                'is_married'             => $this->married,
                'last_education'         => $this->lastEducation,
                'major'                  => $this->major,
                'job'                    => $this->job,
                'btn_account_number'     => $this->btn,
                'mandiri_account_number' => $this->mandiri,
            ]);

            $member->address()->updateOrCreate(
                ['user_id' => $member->id],
                [
                    'address_type' => $this->addressType,
                    'full_address' => $this->fullAddress,
                ]
            );

            $member->family()->updateOrCreate(
                ['user_id' => $member->id],
                [
                    'father_name'           => $this->fatherName,
                    'mother_name'           => $this->motherName,
                    'family_status'         => $this->familyStatus,
                    'number_of_children'    => $this->numberOfChildren,
                    'residential_ownership' => $this->residentialOwnership,
                ]
            );

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

    }
}
