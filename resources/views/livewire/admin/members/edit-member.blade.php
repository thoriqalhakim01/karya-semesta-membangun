<section class="w-full space-y-6">
    @include('partials.users-heading')
    <x-users.layout :member="$member" :heading="__('Profile information')" :subheading="__('Update member profile information such as name, email, and others')">
        <div class="w-full">
            <form wire:submit="save" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <flux:input wire:model="form.name" type="text" label="Full Name" placeholder="John Doe" />
                    <flux:input wire:model="form.email" type="email" label="Email" placeholder="user@example.com" />
                    <flux:input wire:model="form.phone" type="number" label="Phone Number"
                        placeholder="081234567890" />
                    <flux:input wire:model="form.birthOfPlace" type="text" label="Birth Place"
                        placeholder="e.g. Jakarta" />
                    <flux:input wire:model="form.dateOfBirth" type="date" label="Birth Date"
                        placeholder="Choose date" />
                    <flux:select wire:model="form.gender" placeholder="Choose gender..." label="Gender">
                        <flux:select.option value="male">Male</flux:select.option>
                        <flux:select.option value="female">Female</flux:select.option>
                    </flux:select>
                    <flux:select wire:model="form.married" placeholder="Choose gender..." label="Married">
                        <flux:select.option value=1>Married</flux:select.option>
                        <flux:select.option value=0>Not Married</flux:select.option>
                    </flux:select>
                    <flux:input wire:model="form.lastEducation" type="text" label="Last Education"
                        placeholder="e.g. S1" />
                    <flux:input wire:model="form.major" type="text" label="Major" placeholder="e.g. Informatics" />
                    <flux:input wire:model="form.job" type="text" label="Job"
                        placeholder="eg.g. Software Engineer" />
                </div>

                <flux:heading size="lg">Bank Account</flux:heading>

                <div class="grid grid-cols-2 gap-4">
                    <flux:input wire:model="form.btn" type="number" label="BTN" placeholder="1234567890" />
                    <flux:input wire:model="form.mandiri" type="number" label="Mandiri" placeholder="1234567890" />
                </div>

                <flux:heading size="lg">Address</flux:heading>

                <div class="grid grid-cols-2 gap-4">
                    <flux:select wire:model="form.addressType" placeholder="Choose type..." label="Address Type">
                        <flux:select.option value="home">Home</flux:select.option>
                        <flux:select.option value="ktp">KTP</flux:select.option>
                        <flux:select.option value="domicile">Domicile</flux:select.option>
                    </flux:select>
                    <flux:input wire:model="form.fullAddress" type="text" label="Full Address"
                        placeholder="e.g. Jl. Raya Jakarta No. 1" />
                </div>

                <flux:heading size="lg">Family</flux:heading>

                <div class="grid grid-cols-2 gap-4">
                    <flux:input wire:model="form.fatherName" type="text" label="Father Name"
                        placeholder="e.g. John Doe" />
                    <flux:input wire:model="form.motherName" type="text" label="Mother Name"
                        placeholder="e.g. Jane Doe" />
                    <flux:select wire:model="form.familyStatus" placeholder="Choose status..." label="Family Status">
                        <flux:select.option value="father">Father</flux:select.option>
                        <flux:select.option value="mother">Mother</flux:select.option>
                        <flux:select.option value="child">Child</flux:select.option>
                    </flux:select>
                    <flux:input wire:model="form.numberOfChildren" type="number" label="Number of Children"
                        placeholder="e.g. 2" />
                    <flux:select wire:model="form.residentialOwnership" placeholder="Choose ownership..."
                        label="Residential Ownership">
                        <flux:select.option value="rent">Rent</flux:select.option>
                        <flux:select.option value="own">Own</flux:select.option>
                    </flux:select>
                </div>

                <div class="flex justify-end mt-6">
                    <flux:button type="submit" variant="primary">
                        Save Changes
                    </flux:button>
                </div>
            </form>
        </div>
    </x-users.layout>
</section>
