<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="flex flex-1 justify-between items-start">
        <div>
            <flux:heading size="xl">Edit Transaction</flux:heading>
            <flux:text>Program section</flux:text>
        </div>
        <flux:button icon="x-mark" variant="outline" href="{{ route('admin.transactions.index') }}">
            Cancel
        </flux:button>
    </div>
    <div class="w-full max-w-lg mx-auto">
        <form wire:submit="save" class="space-y-2">
            <flux:input wire:model.lazy="form.date" type="date" label="Transaction date" />
            <flux:select wire:model.lazy="form.user" label="Member" placeholder="Choose member">
                @foreach ($users as $user)
                    <flux:select.option value="{{ $user->id }}">{{ $user->name }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:select wire:model.lazy="form.program" label="Program" placeholder="Choose program">
                @foreach ($userPrograms as $program)
                    <flux:select.option value="{{ $program->id }}">{{ $program->name }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:select wire:model.lazy="form.type" label="Type" placeholder="Choose type">
                <flux:select.option value="loyalty">Loyalty</flux:select.option>
                <flux:select.option value="personal">Personal</flux:select.option>
            </flux:select>
            <flux:input wire:model.lazy="form.amount" type="number" label="Amount" />
            <flux:select wire:model.lazy="form.payment" label="Payment method" placeholder="Choose payment method">
                <flux:select.option value="cash">Cash</flux:select.option>
                <flux:select.option value="transfer">Transfer</flux:select.option>
            </flux:select>
            <flux:button class="mt-4 w-full" variant="primary" type="submit">Save</flux:button>
        </form>
    </div>
</div>
