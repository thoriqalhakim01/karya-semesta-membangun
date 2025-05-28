<div>
    <flux:modal.trigger name="edit-investment">
        <flux:button variant="outline" icon="pencil-square">
            Edit
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-investment" focusable class="w-full max-w-xl space-y-8">
        <div>
            <flux:heading size="xl">Edit Investment</flux:heading>
            <flux:subheading>
                Let's fill out the form below to edit an investment.
            </flux:subheading>
        </div>
        <form wire:submit="save" class="space-y-6">
            <flux:input wire:model="form.name" type="text" label="Investment Name" placeholder="Investment Name" />
            <div class="flex justify-end gap-4">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">
                    Save Changes
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
