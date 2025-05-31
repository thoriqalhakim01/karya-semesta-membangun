<div class="flex flex-col gap-4">
    <flux:avatar name="{{ $member->name }}" />
    <flux:heading size="xl">{{ $member->name }}</flux:heading>
    <div class="border rounded-md p-4 flex flex-col gap-2">
        <flux:heading size="lg">Contacts</flux:heading>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <flux:heading>Email</flux:heading>
                <flux:text>{{ $member->email }}</flux:text>
            </div>
            <div>
                <flux:heading>Phone Number</flux:heading>
                <flux:text>{{ $member->phone }}</flux:text>
            </div>
        </div>
    </div>

    {{-- ?Details --}}
    <div class="border-b p-2 flex flex-col gap-2">
        <button wire:click="setShowDetail"
            class="group flex justify-between items-center transition duration-300 ease-in-out">
            <flux:heading size="lg" class="group-hover:underline">Details</flux:heading>
            <flux:icon.chevron-down
                class="{{ $showDetail ? 'rotate-180' : '' }} size-4 transition duration-300 ease-in-out" />
        </button>
        <div class="{{ $showDetail ? 'block' : 'hidden' }} grid grid-cols-2 gap-4 transition duration-300 ease-in-out">
            <div>
                <flux:heading>Birth Place</flux:heading>
                <flux:text>{{ $member->detail->birth_place ?? '-' }}</flux:text>
            </div>
            <div>
                <flux:heading>Birth Date</flux:heading>
                <flux:text>{{ $member->detail->birth_date ?? '-' }}</flux:text>
            </div>
            <div>
                <flux:heading>Gender</flux:heading>
                <flux:text class="capitalize">{{ $member->detail->gender ?? '-' }}</flux:text>
            </div>
            <div>
                <flux:heading>Married</flux:heading>
                <flux:text>{{ $member->detail->is_married ? 'Married' : 'Not Married' }}</flux:text>
            </div>
            <div>
                <flux:heading>Last Edecation</flux:heading>
                <flux:text>{{ $member->detail->last_education ?? '-' }}</flux:text>
            </div>
            <div>
                <flux:heading>Major</flux:heading>
                <flux:text>{{ $member->detail->major ?? '-' }}</flux:text>
            </div>
            <div>
                <flux:heading>Job</flux:heading>
                <flux:text>{{ $member->detail->job ?? '-' }}</flux:text>
            </div>
        </div>
    </div>

    {{-- ?Bank Account --}}
    <div class="border-b p-2 flex flex-col gap-2">
        <button wire:click="setShowBankAccount  "
            class="group flex justify-between items-center transition duration-300 ease-in-out">
            <flux:heading size="lg" class="group-hover:underline">Bank Account</flux:heading>
            <flux:icon.chevron-down
                class="{{ $showBankAccount ? 'rotate-180' : '' }} size-4 transition duration-300 ease-in-out" />
        </button>
        <div
            class="{{ $showBankAccount ? 'block' : 'hidden' }} grid grid-cols-2 gap-4 transition duration-300 ease-in-out">
            <div>
                <flux:heading>BTN Account Number</flux:heading>
                <flux:text variant="strong" class="font-medium text-md">
                    {{ $member->detail->btn_account_number ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:heading>Mandiri Account Number</flux:heading>
                <flux:text variant="strong" class="font-medium text-md">
                    {{ $member->detail->mandiri_account_number ?? '-' }}
                </flux:text>
            </div>
        </div>
    </div>

    {{-- ?Address --}}
    <div class="border-b p-2 flex flex-col gap-2">
        <button wire:click="setShowAddress"
            class="group flex justify-between items-center transition duration-300 ease-in-out">
            <flux:heading size="lg" class="group-hover:underline">Address</flux:heading>
            <flux:icon.chevron-down
                class="{{ $showAddress ? 'rotate-180' : '' }} size-4 transition duration-300 ease-in-out" />
        </button>
        <div
            class="{{ $showAddress ? 'block' : 'hidden' }} space-y-4 transition duration-300 ease-in-out">
            <div>
                <flux:heading>Type</flux:heading>
                <flux:text class="capitalize">{{ $member->address->address_type ?? '-' }}</flux:text>
            </div>
            <div>
                <flux:heading>Full Address</flux:heading>
                <flux:text>{{ $member->address->full_address ?? '-' }}</flux:text>
            </div>
        </div>
    </div>

    {{-- ?Family --}}
    <div class="border-b p-2 flex flex-col gap-2">
        <button wire:click="setShowFamily"
            class="group flex justify-between items-center transition duration-300 ease-in-out">
            <flux:heading size="lg" class="group-hover:underline">Family</flux:heading>
            <flux:icon.chevron-down
                class="{{ $showFamily ? 'rotate-180' : '' }} size-4 transition duration-300 ease-in-out" />
        </button>
        <div class="{{ $showFamily ? 'block' : 'hidden' }} grid grid-cols-2 gap-4 transition duration-300 ease-in-out">
            <div>
                <flux:heading>Father Name</flux:heading>
                <flux:text>{{ $member->family->father_name ?? '-' }}</flux:text>
            </div>
            <div>
                <flux:heading>Mother Name</flux:heading>
                <flux:text>{{ $member->family->mother_name ?? '-' }}</flux:text>
            </div>
            <div>
                <flux:heading>Family Status</flux:heading>
                <flux:text class="capitalize">{{ $member->family->family_status ?? '-' }}</flux:text>
            </div>
            <div>
                <flux:heading>Number of Children</flux:heading>
                <flux:text>{{ $member->family->number_of_children ?? '-' }}</flux:text>
            </div>
            <div>
                <flux:heading>Residential Ownership</flux:heading>
                <flux:text>{{ $member->family->residential_ownership ?? '-' }}</flux:text>
            </div>
        </div>
    </div>
</div>
