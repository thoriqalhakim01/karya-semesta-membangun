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
                    'name.required'        => 'Nama lengkap wajib diisi.',
                    'name.min'             => 'Nama minimal 2 karakter.',
                    'name.max'             => 'Nama maksimal 255 karakter.',
                    'email.required'       => 'Email wajib diisi.',
                    'email.email'          => 'Format email tidak valid.',
                    'email.unique'         => 'Email sudah terdaftar.',
                    'phone.required'       => 'Nomor telepon wajib diisi.',
                    'phone.numeric'        => 'Nomor telepon harus berupa angka.',
                    'phone.digits_between' => 'Nomor telepon harus 10-15 digit.',
                    'gender.required'      => 'Jenis kelamin wajib dipilih.',
                    'gender.in'            => 'Jenis kelamin harus male atau female.',
                    'dateOfBirth.required' => 'Tanggal lahir wajib diisi.',
                    'dateOfBirth.date'     => 'Format tanggal lahir tidak valid.',
                    'dateOfBirth.before'   => 'Tanggal lahir harus sebelum hari ini.',
                ];

            case 2:
                return [
                    'programs.*.exists'    => 'Program yang dipilih tidak valid.',
                    'investments.*.exists' => 'Investasi yang dipilih tidak valid.',
                ];

            case 3:
                return [
                    'password.required'        => 'Password wajib diisi.',
                    'password.min'             => 'Password minimal 8 karakter.',
                    'confirmPassword.required' => 'Konfirmasi password wajib diisi.',
                    'confirmPassword.same'     => 'Konfirmasi password tidak cocok.',
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

            if ($this->programs) {
                $user->programs()->attach($this->programs, ['created_at' => now(), 'updated_at' => now()]);
            }

            if ($this->investments) {
                $user->investments()->attach($this->investments, ['created_at' => now(), 'updated_at' => now()]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
