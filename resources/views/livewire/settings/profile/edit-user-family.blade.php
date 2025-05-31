<div>
    <flux:modal.trigger name="edit-user-family">
        <flux:button variant="outline" size="sm" icon="pencil-square" class="cursor-pointer">
            Edit
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-user-family" focusable class="w-full max-w-xl space-y-8">
        <div>
            <flux:heading size="xl">Edit Family Information</flux:heading>
            <flux:subheading>
                Let's fill out the form below to edit your family information .
            </flux:subheading>
        </div>
        <form wire:submit="save" class="space-y-6">
            <flux:input wire:model="fatherName" type="text" label="Father Name" placeholder="e.g. John Doe" />
            <flux:input wire:model="motherName" type="text" label="Mother Name" placeholder="e.g. Jane Doe" />
            <flux:select wire:model="familyStatus" placeholder="Choose family status..." label="Family Status">
                <flux:select.option value="father">Father</flux:select.option>
                <flux:select.option value="mother">Mother</flux:select.option>
                <flux:select.option value="child">Child</flux:select.option>
            </flux:select>
            <flux:input wire:model="numberOfChildren" type="number" label="Number of Children" placeholder="e.g. 2" />
            <flux:select wire:model="residentialOwnership" placeholder="Choose residential ownership..."
                label="Residential Ownership">
                <flux:select.option value="rent">Rent</flux:select.option>
                <flux:select.option value="own">Own</flux:select.option>
            </flux:select>
            <div class="flex justify-end mt-6">
                <flux:button type="submit" variant="primary">
                    Save Changes
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
