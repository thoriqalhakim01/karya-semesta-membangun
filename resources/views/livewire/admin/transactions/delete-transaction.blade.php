<?php

use Livewire\Volt\Component;

new class extends Component {
    public $transaction;

    public function delete()
    {
        $this->transaction->delete();

        $this->redirect(route('admin.transactions.index'), navigate: true);
    }
}; ?>

<div>
    <flux:modal.trigger name="delete-transaction">
        <flux:button variant="ghost" size="sm">
            <flux:icon.trash class="text-red-500 size-5" />
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="delete-transaction" focusable class="w-full max-w-xl space-y-8">
        <div>
            <flux:heading size="xl">Delete Transaction</flux:heading>
            <flux:subheading>
                Are you sure you want to delete this transaction?
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
