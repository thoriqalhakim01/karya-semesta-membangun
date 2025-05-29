<div>
    <flux:button wire:click="openModal" variant="ghost" size="sm">
        <flux:icon.eye class="size-5" />
    </flux:button>

    <flux:modal wire:model="showModal" focusable class="w-full max-w-xl space-y-8">
        <div>
            <flux:heading size="xl">Detail Transaction</flux:heading>
            <flux:text>
                View detailed information about this transaction.
            </flux:text>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <flux:label>Transaction date</flux:label>
                <flux:text>{{ Carbon\Carbon::parse($transaction->transaction_date)->translatedFormat('d F Y') }}
                </flux:text>
            </div>
            <div>
                <flux:label>Member name</flux:label>
                <flux:text>{{ $transaction->user->name }}</flux:text>
            </div>
            <div>
                <flux:label>Transaction name</flux:label>
                <flux:text>{{ $transaction->transactionable->name }}</flux:text>
            </div>
            <div>
                <flux:label>Transaction type</flux:label>
                <flux:text>
                    {{ class_basename($transaction->transactionable_type) }}
                    @if ($transaction->transactionable_type == 'App\Models\Program')
                        - <span class="capitalize">{{ $transaction->transaction_type }}</span>
                    @endif
                </flux:text>
            </div>
            <div>
                <flux:label>Amount</flux:label>
                <flux:text>{{ number_format($transaction->amount, 0, ',', '.') }}</flux:text>
            </div>
            <div>
                <flux:label>Payment method</flux:label>
                <flux:text>{{ $transaction->payment_method }}</flux:text>
            </div>
        </div>
        <div class="flex justify-end">
            <flux:button wire:click="closeModal" variant="outline">Close</flux:button>
        </div>
    </flux:modal>
</div>
