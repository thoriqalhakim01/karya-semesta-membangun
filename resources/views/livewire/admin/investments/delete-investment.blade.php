<?php

use Livewire\Volt\Component;

new class extends Component {
    public $investment;

    public function delete()
    {
        $this->investment->delete();

        $this->redirect(route('admin.investments.index'), navigate: true);
    }
}; ?>

<div>
    <flux:modal.trigger name="delete-investment">
        <flux:button variant="danger" icon="trash">
            Delete
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="delete-investment" focusable class="w-full max-w-xl space-y-8">
        <div>
            <flux:heading size="xl">Delete Investment</flux:heading>
            <flux:subheading>
                Are you sure you want to delete this investment?
            </flux:subheading>
        </div>
        <form wire:submit="delete">
            <div class="flex justify-end gap-4">
                <flux:modal.close>
                    <flux:button variant="outline">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger">
                    Delete
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
