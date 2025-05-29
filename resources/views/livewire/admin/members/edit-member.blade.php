<section class="w-full space-y-6">
    @include('partials.users-heading')
    <x-users.layout :member="$member" :heading="__('Profile information')" :subheading="__('Update member profile information such as name, email, and others')">
        <div class="w-full">
            <form wire:submit="save">
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
                <div class="flex justify-end mt-6">
                    <flux:button type="submit" variant="primary">
                        Save Changes
                    </flux:button>
                </div>
            </form>
        </div>
    </x-users.layout>
</section>
