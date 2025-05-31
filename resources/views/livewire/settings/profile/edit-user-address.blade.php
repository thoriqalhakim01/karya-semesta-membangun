<div>
    <flux:modal.trigger name="edit-user-address">
        <flux:button variant="outline" size="sm" icon="pencil-square" class="cursor-pointer">
            Edit
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-user-address" focusable class="w-full max-w-xl space-y-8">
        <div>
            <flux:heading size="xl">Edit Address Information</flux:heading>
            <flux:subheading>
                Let's fill out the form below to edit your address information.
            </flux:subheading>
        </div>
        <form wire:submit="save" class="space-y-6">
            <flux:select wire:model="type" placeholder="Choose address type..." label="Type">
                <flux:select.option value="home">Home</flux:select.option>
                <flux:select.option value="ktp">KTP</flux:select.option>
                <flux:select.option value="domicile">Domicile</flux:select.option>
            </flux:select>

            <flux:input wire:model="fullAddress" type="" label="Address" placeholder="e.g. Jl. Raya No. 123" />

            <div class="flex justify-end mt-6">
                <flux:button type="submit" variant="primary">
                    Save Changes
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
