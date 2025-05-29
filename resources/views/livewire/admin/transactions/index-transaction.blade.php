<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="flex flex-1 justify-between items-center">
        <flux:heading size="xl">Transaction Listing</flux:heading>
        <flux:dropdown>
            <flux:button variant="primary" icon:trailing="chevron-down">Create New</flux:button>
            <flux:menu>
                <flux:menu.item :href="route('admin.transaction.create-program')">Add Program Transaction
                </flux:menu.item>
                <flux:menu.item :href="route('admin.transaction.create-investment')">Add Investment
                    Transaction</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </div>
    <div class="flex flex-1 flex-col gap-4">
        <div class="flex gap-2 items-center">
            <div class="lg:w-1/3">
                <flux:input wire:model.live="search" type="text" placeholder="Search Transaction" />
            </div>
            <flux:dropdown align="start" position="bottom">
                <flux:button icon="funnel" variant="ghost">
                    Filter
                </flux:button>

                <flux:menu>
                    <flux:menu.item wire:click="$set('transactionableType', 'program')">
                        <div class="flex items-center">
                            <span>Program</span>
                            @if ($transactionableType === 'program')
                                <flux:icon.check class="ml-2 h-4 w-4" />
                            @endif
                        </div>
                    </flux:menu.item>
                    <flux:menu.item wire:click="$set('transactionableType', 'investment')">
                        <div class="flex items-center">
                            <span>Investment</span>
                            @if ($transactionableType === 'investment')
                                <flux:icon.check class="ml-2 h-4 w-4" />
                            @endif
                        </div>
                    </flux:menu.item>
                    <flux:menu.separator />
                    @if ($transactionableType === 'program')
                        <flux:menu.item wire:click="$set('programType', 'loyalty')">
                            <div class="flex items-center">
                                <span>Loyalty</span>
                                @if ($programType === 'loyalty')
                                    <flux:icon.check class="ml-2 h-4 w-4" />
                                @endif
                            </div>
                        </flux:menu.item>
                        <flux:menu.item wire:click="$set('programType', 'personal')">
                            <div class="flex items-center">
                                <span>Personal</span>
                                @if ($programType === 'personal')
                                    <flux:icon.check class="ml-2 h-4 w-4" />
                                @endif
                            </div>
                        </flux:menu.item>
                        <flux:menu.separator />
                    @endif
                    <div class="px-2 py-1">
                        <div class="space-y-2">
                            <flux:input type="date" wire:model.live="startDate" placeholder="Start Date" />
                            <flux:input type="date" wire:model.live="endDate" placeholder="End Date" />
                        </div>
                    </div>
                    <flux:menu.separator />
                    <flux:menu.item wire:click="resetFilters">
                        Reset Filters
                    </flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </div>
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Transaction Date</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Transaction Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Transaction Type</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Amount</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse ($transactions as $item)
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ Carbon\Carbon::parse($item->transaction_date)->translatedFormat('d F Y') }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->user->name }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ class_basename($item->transactionable_type) }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            <span>{{ $item->transactionable->name }}</span>
                                            @if ($item->transactionable_type == 'App\Models\Program')
                                                - <span class="capitalize">{{ $item->transaction_type }}</span>
                                            @endif
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ number_format($item->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap flex justify-end">
                                            <flux:button variant="ghost" size="sm">
                                                <flux:icon.pencil-square class="text-green-500 size-5" />
                                            </flux:button>
                                            <flux:button variant="ghost" size="sm">
                                                <flux:icon.trash class="text-red-500 size-5" />
                                            </flux:button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-6 py-4 text-center text-sm text-gray-500 dark:text-neutral-400">
                                            No transactions found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
