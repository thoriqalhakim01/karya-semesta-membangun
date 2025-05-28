<?php
namespace App\Livewire\Admin\Members;

use App\Livewire\Forms\Admin\Members\CreateMemberForm;
use App\Models\Investment;
use App\Models\Program;
use Livewire\Component;

class CreateMember extends Component
{
    public CreateMemberForm $form;
    public $currentStep = 1;
    public $totalSteps  = 4;

    public $programList        = [];
    public $investmentList     = [];
    public $programSelected    = [];
    public $investmentSelected = [];

    public function mount()
    {
        $this->programList    = Program::all();
        $this->investmentList = Investment::all();

        $this->form->programs    = [''];
        $this->form->investments = [''];
    }

    public function nextStep()
    {
        try {
            switch ($this->currentStep) {
                case 1:
                    $this->form->validateBasicInfo();
                    break;

                case 2:
                    $this->form->validateProgramsInvestments();
                    $this->updateSelectedItems();
                    break;

                case 3:
                    $this->form->validateCredentials();
                    break;
            }

            if ($this->currentStep < $this->totalSteps) {
                $this->currentStep++;
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function addProgramRow()
    {
        $this->form->programs[] = '';
    }

    public function removeProgramRow($index)
    {
        if (count($this->form->programs) > 1) {
            unset($this->form->programs[$index]);
            $this->form->programs = array_values($this->form->programs);
        }
    }

    public function addInvestmentRow()
    {
        $this->form->investments[] = '';
    }

    public function removeInvestmentRow($index)
    {
        if (count($this->form->investments) > 1) {
            unset($this->form->investments[$index]);
            $this->form->investments = array_values($this->form->investments);
        }
    }

    public function updateSelectedItems()
    {
        $selectedProgramIds    = array_filter($this->form->programs);
        $this->programSelected = Program::whereIn('id', $selectedProgramIds)->get();

        $selectedInvestmentIds    = array_filter($this->form->investments);
        $this->investmentSelected = Investment::whereIn('id', $selectedInvestmentIds)->get();
    }

    public function save()
    {
        try {
            $this->form->store();

            session()->flash('message', 'Member berhasil dibuat!');
            return redirect()->route('admin.members.index');

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    // Method untuk validasi real-time (opsional)
    public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'form.') && $this->currentStep == 1) {
            $field = str_replace('form.', '', $propertyName);

            if (in_array($field, ['name', 'email', 'phone', 'gender', 'dateOfBirth'])) {
                $this->validateOnly($propertyName, $this->form->rulesForStep(1), $this->form->messagesForStep(1));
            }
        }

        if (str_starts_with($propertyName, 'form.') && $this->currentStep == 3) {
            $field = str_replace('form.', '', $propertyName);

            if (in_array($field, ['password', 'confirmPassword'])) {
                $this->validateOnly($propertyName, $this->form->rulesForStep(3), $this->form->messagesForStep(3));
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.members.create-member');
    }
}
