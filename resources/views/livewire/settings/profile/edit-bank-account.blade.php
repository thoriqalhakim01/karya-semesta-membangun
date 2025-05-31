<div>
    <flux:modal.trigger name="edit-bank-account">
        <flux:button variant="outline" size="sm" icon="pencil-square" class="cursor-pointer">
            Edit
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-bank-account" focusable class="w-full max-w-xl space-y-8">
        <div>
            <flux:heading size="xl">Edit Bank Account</flux:heading>
            <flux:subheading>
                Let's fill out the form below to edit your bank account information .
            </flux:subheading>
        </div>
        <form wire:submit="save" class="space-y-6">
            <flux:input wire:model="btnAccountNumber" type="text" label="BTN Account Number"
                placeholder="e.g. 1234567890" />
            <flux:input wire:model="mandiriAccountNumber" type="text" label="Mandiri Account Number"
                placeholder="e.g. 1234567890" />
            <div class="flex justify-end mt-6">
                <flux:button type="submit" variant="primary">
                    Save Changes
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
