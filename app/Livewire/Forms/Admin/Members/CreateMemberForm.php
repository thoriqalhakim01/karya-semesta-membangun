<?php
namespace App\Livewire\Forms\Admin\Members;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Form;

class CreateMemberForm extends Form
{
    public $programs    = [];
    public $investments = [];

    public $name            = '';
    public $email           = '';
    public $phone           = '';
    public $gender          = '';
    public $dateOfBirth     = '';
    public $password        = '';
    public $confirmPassword = '';

    public function rulesForStep($step)
    {
        switch ($step) {
            case 1:
                return [
                    'name'        => 'required|string|min:2|max:255',
                    'email'       => 'required|email|max:255|unique:users,email',
                    'phone'       => 'required|numeric|digits_between:10,15',
                    'gender'      => 'required|in:male,female',
                    'dateOfBirth' => 'required|date|before:today',
                ];

            case 2:
                return [
                    'programs.*'    => 'nullable|exists:programs,id',
                    'investments.*' => 'nullable|exists:investments,id',
                ];

            case 3:
                return [
                    'password'        => 'required|min:8|max:255',
                    'confirmPassword' => 'required|same:password',
                ];

            default:
                return [];
        }
    }

    public function messagesForStep($step)
    {
        switch ($step) {
            case 1:
                return [
                    'name.required'        => 'Full name is required.',
                    'name.min'             => 'Full name must be at least 2 characters.',
                    'name.max'             => 'Full name must not be more than 255 characters.',
                    'email.required'       => 'Email is required.',
                    'email.email'          => 'Invalid email format.',
                    'email.unique'         => 'Email is already registered.',
                    'phone.required'       => 'Phone number is required.',
                    'phone.numeric'        => 'Phone number must be a number.',
                    'phone.digits_between' => 'Phone number must be between 10-15 digits.',
                    'gender.required'      => 'Gender is required.',
                    'gender.in'            => 'Gender must be male or female.',
                    'dateOfBirth.required' => 'Date of birth is required.',
                    'dateOfBirth.date'     => 'Invalid date of birth format.',
                    'dateOfBirth.before'   => 'Date of birth must be before today.',
                ];

            case 2:
                return [
                    'programs.*.exists'    => 'Program is not valid.',
                    'investments.*.exists' => 'Investment is not valid.',
                ];

            case 3:
                return [
                    'password.required'        => 'Password is required.',
                    'password.min'             => 'Password must be at least 8 characters.',
                    'confirmPassword.required' => 'Confirm password is required.',
                    'confirmPassword.same'     => 'Confirm password does not match.',
                ];

            default:
                return [];
        }
    }

    public function validateStep($step)
    {
        $rules    = $this->rulesForStep($step);
        $messages = $this->messagesForStep($step);

        $this->validate($rules, $messages);
    }

    public function validateBasicInfo()
    {
        $this->validateStep(1);
    }

    public function validateProgramsInvestments()
    {
        $this->validateStep(2);
    }

    public function validateCredentials()
    {
        $this->validateStep(3);
    }

    public function validateAll()
    {
        $allRules = array_merge(
            $this->rulesForStep(1),
            $this->rulesForStep(2),
            $this->rulesForStep(3)
        );

        $allMessages = array_merge(
            $this->messagesForStep(1),
            $this->messagesForStep(2),
            $this->messagesForStep(3)
        );

        $this->validate($allRules, $allMessages);
    }

    public function store()
    {
        $this->validateAll();

        DB::beginTransaction();

        try {
            $user = User::create([
                'name'     => $this->name,
                'email'    => $this->email,
                'phone'    => $this->phone,
                'password' => Hash::make($this->password),
            ]);

            $user->assignRole('user');

            $user->detail()->create([
                'birth_date' => $this->dateOfBirth,
                'gender'     => $this->gender,
            ]);

            $user->family()->create();

            $user->address()->create();

            if (! empty($this->programs) && ! in_array('', $this->programs, true)) {
                $user->programs()->attach($this->programs, ['created_at' => now(), 'updated_at' => now()]);
            }

            if (! empty($this->investments) && ! in_array('', $this->investments, true)) {
                $user->investments()->attach($this->investments, ['created_at' => now(), 'updated_at' => now()]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
