<form wire:submit="save">
    @if ($currentStep == 1)
        <div class="flex flex-col mt-4 space-y-6">
            <div class="text-center">
                <flux:heading size="lg">Basics Information</flux:heading>
                <flux:subheading>Let's fill out the basic information for the member</flux:subheading>
            </div>
            <div class="space-y-4 w-full max-w-xl mx-auto">
                <flux:input wire:model="form.name" type="text" label="Full Name" placeholder="John Doe" />
                <flux:input wire:model="form.email" type="email" label="Email" placeholder="user@example.com" />
                <flux:input wire:model="form.phone" type="number" label="Phone Number" placeholder="081234567890" />
                <flux:select wire:model="form.gender" placeholder="Choose gender..." label="Gender">
                    <flux:select.option value="male">Male</flux:select.option>
                    <flux:select.option value="female">Female</flux:select.option>
                </flux:select>
                <flux:input wire:model="form.dateOfBirth" type="date" label="Birth Date" placeholder="Full Name" />
                <flux:button type="button" variant="primary" class="w-full mt-4" wire:click="nextStep">
                    Next
                </flux:button>
            </div>
        </div>
    @endif
    @if ($currentStep == 2)
        <div class="flex flex-col mt-4 space-y-6">
            <div class="text-center">
                <flux:heading size="lg">Program and Investment</flux:heading>
                <flux:subheading>Choose the program and investment for the member</flux:subheading>
            </div>
            <div class="space-y-4 w-full max-w-xl mx-auto">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-2">
                        <flux:label>Program</flux:label>
                        @foreach ($form->programs as $index => $program)
                            <div class="flex gap-2">
                                <flux:select class="w-full" placeholder="Choose program..."
                                    wire:model="form.programs.{{ $index }}">
                                    @foreach ($programList as $program)
                                        <flux:select.option value="{{ $program->id }}">{{ $program->name }}
                                        </flux:select.option>
                                    @endforeach
                                </flux:select>
                                @if ($index < count($form->programs) - 1)
                                    <flux:button icon="minus" type="button" variant="danger"
                                        wire:click="removeProgramRow({{ $index }})">
                                    </flux:button>
                                @endif
                            </div>
                        @endforeach
                        <div class="flex justify-end">
                            <flux:button icon="plus" type="button" variant="primary" wire:click="addProgramRow">
                            </flux:button>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <flux:label>Investment</flux:label>
                        @foreach ($form->investments as $index => $investment)
                            <div class="flex gap-2">
                                <flux:select class="w-full" placeholder="Choose investment..."
                                    wire:model="form.investments.{{ $index }}">
                                    @foreach ($investmentList as $investment)
                                        <flux:select.option value="{{ $investment->id }}">{{ $investment->name }}
                                        </flux:select.option>
                                    @endforeach
                                </flux:select>
                                @if ($index < count($form->investments) - 1)
                                    <flux:button icon="minus" type="button" variant="danger"
                                        wire:click="removeInvestmentRow({{ $index }})">
                                    </flux:button>
                                @endif
                            </div>
                        @endforeach
                        <div class="flex justify-end">
                            <flux:button icon="plus" type="button" variant="primary" wire:click="addInvestmentRow">
                            </flux:button>
                        </div>
                    </div>
                </div>
                <div class="flex gap-4">
                    <flux:button type="button" variant="outline" class="w-full" wire:click="previousStep">
                        Previous
                    </flux:button>
                    <flux:button type="button" variant="primary" class="w-full" wire:click="nextStep">
                        Next
                    </flux:button>
                </div>
            </div>
        </div>
    @endif
    @if ($currentStep == 3)
        <div class="flex flex-col mt-4 space-y-6">
            <div class="text-center">
                <flux:heading size="lg">Credentials</flux:heading>
                <flux:subheading>Set up the login credentials for the member</flux:subheading>
            </div>
            <div class="space-y-4 w-full max-w-xl mx-auto">
                <flux:input wire:model="form.password" type="password" label="Password" placeholder="Enter password" />
                <flux:input wire:model="form.confirmPassword" type="password" label="Confirm Password"
                    placeholder="Confirm your password" />
                <div class="flex gap-4">
                    <flux:button type="button" variant="outline" class="w-full" wire:click="previousStep">
                        Previous
                    </flux:button>
                    <flux:button type="button" variant="primary" class="w-full" wire:click="nextStep">
                        Next
                    </flux:button>
                </div>
            </div>
        </div>
    @endif
    @if ($currentStep == 4)
        <div class="flex flex-col mt-4 space-y-6">
            <div class="text-center">
                <flux:heading size="lg">Overview</flux:heading>
                <flux:subheading>Double check the information before submitting</flux:subheading>
            </div>
            <div class="space-y-4 w-full max-w-xl mx-auto">
                <div class="rounded-md border p-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col gap-2">
                            <flux:label>Name</flux:label>
                            <flux:text>{{ $form->name }}</flux:text>
                        </div>
                        <div class="flex flex-col gap-2">
                            <flux:label>Email</flux:label>
                            <flux:text>{{ $form->email }}</flux:text>
                        </div>
                        <div class="flex flex-col gap-2">
                            <flux:label>Phone</flux:label>
                            <flux:text>{{ $form->phone }}</flux:text>
                        </div>
                        <div class="flex flex-col gap-2">
                            <flux:label>Gender</flux:label>
                            <flux:text class="capitalize">{{ $form->gender }}</flux:text>
                        </div>
                        <div class="flex flex-col gap-2">
                            <flux:label>Date of Birth</flux:label>
                            <flux:text>{{ $form->dateOfBirth }}</flux:text>
                        </div>
                    </div>
                </div>
                <div class="rounded-md border p-4 space-y-4">
                    <div class="flex flex-col gap-2">
                        <flux:label>Programs</flux:label>
                        <div class="flex flex-wrap gap-2">
                            @forelse ($programSelected as $program)
                                <flux:badge color="green">{{ $program->name }}</flux:badge>
                            @empty
                                <flux:text>No programs selected</flux:text>
                            @endforelse
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <flux:label>Investments</flux:label>
                        <div class="flex flex-wrap gap-2">
                            @forelse ($investmentSelected as $investment)
                                <flux:badge color="blue">{{ $investment->name }}</flux:badge>
                            @empty
                                <flux:text>No investments selected</flux:text>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="flex gap-4">
                    <flux:button type="button" variant="outline" class="w-full" wire:click="previousStep">
                        Previous
                    </flux:button>
                    <flux:button type="submit" variant="primary" class="w-full" wire:click="nextStep">
                        Submit
                    </flux:button>
                </div>
            </div>
        </div>
    @endif
</form>
