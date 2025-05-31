<div>
    <flux:modal.trigger name="edit-user-detail">
        <flux:button variant="outline" size="sm" icon="pencil-square" class="cursor-pointer">
            Edit
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-user-detail" focusable class="w-full max-w-xl space-y-8">
        <div>
            <flux:heading size="xl">Edit Personal Information</flux:heading>
            <flux:subheading>
                Let's fill out the form below to edit your personal information .
            </flux:subheading>
        </div>
        <form wire:submit="save" class="space-y-6">
            <flux:input wire:model="birthOfPlace" type="text" label="Birth Place" placeholder="e.g. Jakarta" />
            <flux:input wire:model="birthOfDate" type="date" label="Birth Date" placeholder="Choose date" />
            <flux:select wire:model="gender" placeholder="Choose gender..." label="Gender">
                <flux:select.option value="male">Male</flux:select.option>
                <flux:select.option value="female">Female</flux:select.option>
            </flux:select>
            <flux:select wire:model="married" placeholder="Choose gender..." label="Married">
                <flux:select.option value=1>Married</flux:select.option>
                <flux:select.option value=0>Not Married</flux:select.option>
            </flux:select>
            <flux:input wire:model="lastEducation" type="text" label="Last Education" placeholder="e.g. S1" />
            <flux:input wire:model="major" type="text" label="Major" placeholder="e.g. Informatics" />
            <flux:input wire:model="job" type="text" label="Job" placeholder="eg.g. Software Engineer" />
            <div class="flex justify-end mt-6">
                <flux:button type="submit" variant="primary">
                    Save Changes
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
