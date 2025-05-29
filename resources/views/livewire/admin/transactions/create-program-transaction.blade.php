<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="flex flex-1 justify-between items-start">
        <div>
            <flux:heading size="xl">Create Transaction</flux:heading>
            <flux:text>Program section</flux:text>
        </div>
        <flux:button icon="x-mark" variant="outline" href="{{ route('admin.members.index') }}">
            Cancel
        </flux:button>
    </div>
    <form wire:submit="save" class="space-y-2">
        @foreach ($form->data['transactions'] as $index => $transaction)
            <div class="border rounded-md p-4 space-y-4">
                <div class="grid lg:grid-cols-3 gap-4">
                    <flux:input wire:model.lazy="form.data.transactions.{{ $index }}.date" type="date"
                        label="Transaction date" />
                    <flux:select wire:model.lazy="form.data.transactions.{{ $index }}.user" label="Member"
                        placeholder="Choose member">
                        @foreach ($users as $user)
                            <flux:select.option value="{{ $user->id }}">{{ $user->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:select wire:model.lazy="form.data.transactions.{{ $index }}.program"
                        placeholder="Choose program" name="program" label="Program">
                        @if (isset($userPrograms[$index]))
                            @foreach ($userPrograms[$index] as $program)
                                <flux:select.option value="{{ $program->id }}">{{ $program->name }}
                                </flux:select.option>
                            @endforeach
                        @endif
                    </flux:select>
                    <flux:select wire:model="form.data.transactions.{{ $index }}.type" label="Transaction type"
                        placeholder="Choose transaction type">
                        <flux:select.option value="personal">Personal</flux:select.option>
                        <flux:select.option value="loyalty">Loyalty</flux:select.option>
                    </flux:select>
                    <flux:input wire:model.lazy="form.data.transactions.{{ $index }}.amount" type="number"
                        label="Amount" placeholder="e.g. 1000000" />
                    <flux:input wire:model.lazy="form.data.transactions.{{ $index }}.payment" type="text"
                        label="Payment method" placeholder="e.g. QRIS" />
                </div>
                @if (count($form->data['transactions']) > 1)
                    <flux:button type="button" variant="danger" size="sm"
                        wire:click="removeTransactionRow({{ $index }})">
                        Remove row
                    </flux:button>
                @endif
            </div>
        @endforeach
        <div class="flex justify-between items-center">
            <flux:button type="button" variant="outline" wire:click="addTransactionRow">Add row</flux:button>
            <flux:button type="submit" variant="primary">Create</flux:button>
        </div>
    </form>
</div>
