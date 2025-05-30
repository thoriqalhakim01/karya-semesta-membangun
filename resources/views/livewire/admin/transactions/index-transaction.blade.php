<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">
    {{-- Remove wire:poll.5s to prevent unnecessary updates --}}

    {{-- Flash Messages --}}
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-1 justify-between items-center">
        <flux:heading size="xl">Transaction Listing</flux:heading>
        <flux:dropdown>
            <flux:button variant="primary" icon:trailing="chevron-down">Create New</flux:button>
            <flux:menu>
                <flux:menu.item :href="route('admin.transactions.create-program')">Add Program Transaction
                </flux:menu.item>
                <flux:menu.item :href="route('admin.transactions.create-investment')">Add Investment
                    Transaction</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </div>

    <div class="flex flex-1 flex-col gap-4">
        <div class="flex gap-2 items-center">
            <div class="lg:w-1/3">
                {{-- Add debounce to prevent too frequent updates --}}
                <flux:input wire:model.live.debounce.300ms="search" type="text" placeholder="Search Transaction" />
            </div>
            <flux:dropdown align="start" position="bottom">
                <flux:button icon="funnel" variant="ghost">
                    Filter
                    {{-- Show active filter indicator --}}
                    @if ($transactionableType || $startDate || $endDate || $programType)
                        <span
                            class="ml-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                            @php
                                $activeFilters = collect([$transactionableType, $startDate, $endDate, $programType])
                                    ->filter()
                                    ->count();
                            @endphp
                            {{ $activeFilters }}
                        </span>
                    @endif
                </flux:button>

                <flux:menu>
                    <flux:menu.item wire:click="$set('transactionableType', '')">
                        <div class="flex items-center">
                            <span>All Types</span>
                            @if ($transactionableType === '')
                                <flux:icon.check class="ml-2 h-4 w-4" />
                            @endif
                        </div>
                    </flux:menu.item>
                    <flux:menu.separator />
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
                            {{-- Add debounce to date inputs --}}
                            <flux:input type="date" wire:model.live.debounce.500ms="startDate"
                                placeholder="Start Date" />
                            <flux:input type="date" wire:model.live.debounce.500ms="endDate"
                                placeholder="End Date" />
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
            {{-- Improved loading indicator --}}
            <div wire:loading.delay.longer wire:target="search, transactionableType, startDate, endDate, programType"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <div class="flex items-center space-x-2">
                        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                        <span>Loading transactions...</span>
                    </div>
                </div>
            </div>

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
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Amount</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse ($transactions as $item)
                                    <tr wire:key="transaction-{{ $item->id }}">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ Carbon\Carbon::parse($item->transaction_date)->translatedFormat('d F Y') }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->user->name }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ class_basename($item->transactionable_type) }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            <span>{{ $item->transactionable->name ?? 'N/A' }}</span>
                                            @if ($item->transactionable_type == 'App\Models\Program')
                                                - <span class="capitalize">{{ $item->transaction_type }}</span>
                                            @endif
                                        </td>
                                        <td
                                            class="px-6 py-4 text-end whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ number_format($item->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap flex justify-end">
                                            {{-- Use unique keys for child components --}}
                                            <livewire:admin.transactions.show-transaction :transaction="$item"
                                                :key="'show-' . $item->id" />

                                            <flux:button variant="ghost" size="sm"
                                                :href="$item->transactionable_type === 'App\Models\Program' ?
                                                    route('admin.transactions.edit-program-transactions', $item->id) :
                                                    route('admin.transactions.edit-investment-transactions', $item->id)"
                                                wire:navigate>
                                                <flux:icon.pencil-square class="text-green-500 size-5" />
                                            </flux:button>

                                            <livewire:admin.transactions.delete-transaction :transaction="$item"
                                                :key="'delete-' . $item->id" />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-6 py-4 text-center text-sm text-gray-500 dark:text-neutral-400">
                                            @if ($search || $transactionableType || $startDate || $endDate || $programType)
                                                No transactions found matching your filters.
                                                <button wire:click="resetFilters"
                                                    class="text-blue-600 hover:text-blue-800 underline ml-1">
                                                    Clear filters
                                                </button>
                                            @else
                                                No transactions found
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Pagination --}}
            @if ($transactions->hasPages())
                <div class="mt-4">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
