<div>
    <flux:modal.trigger name="create-program">
        <flux:button variant="primary" icon="plus">
            Create New
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-program" focusable class="w-full max-w-xl space-y-8">
        <div>
            <flux:heading size="xl">Create New Program</flux:heading>
            <flux:subheading>
                Let's fill out the form below to create a new program.
            </flux:subheading>
        </div>
        <form wire:submit="save" class="space-y-6">
            <flux:input wire:model="form.name" type="text" label="Program Name" placeholder="Program Name" />
            <flux:textarea wire:model="form.description" type="text" label="Program Description"
                placeholder="Program Description" />
            <flux:input wire:model="form.target" type="number" label="Program Target" placeholder="Program Target" />
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
