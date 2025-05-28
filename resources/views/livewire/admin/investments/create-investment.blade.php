<div>
    <flux:modal.trigger name="create-investment">
        <flux:button variant="primary" icon="plus">
            Create New
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-investment" focusable class="w-full max-w-xl space-y-8">
        <div>
            <flux:heading size="xl">Create New Investment</flux:heading>
            <flux:subheading>
                Let's fill out the form below to create a new investment.
            </flux:subheading>
        </div>
        <form wire:submit="save" class="space-y-6">
            <flux:input wire:model="form.name" type="text" label="Investment Name" placeholder="Investment Name" />
            <div class="flex justify-end gap-4">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="primary">
                    Create New
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
