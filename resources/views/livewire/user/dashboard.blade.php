<div class="flex w-full min-h-screen flex-1 flex-col gap-4 rounded-xl">
    <div class="flex flex-col">
        <flux:heading size="xl">Dashboard</flux:heading>
        <flux:text class="text-sm">Track your community's activities and progress</flux:text>
    </div>
    <div class="grid grid-cols-4 gap-4">
        <div class="rounded-md border shadow">
            <div class="flex justify-between items-center p-4">
                <flux:avatar icon="arrows-right-left" />
                <div>
                    <flux:select wire:model.live="period">
                        <flux:select.option value="week">This Week</flux:select.option>
                        <flux:select.option value="month">This Month</flux:select.option>
                        <flux:select.option value="year">This Year</flux:select.option>
                    </flux:select>
                </div>
            </div>
            <div class="px-4 pb-4">
                <flux:heading size="sm">Total Transactions</flux:heading>
                <flux:text class="text-4xl font-semibold" variant="strong">{{ $totalTransactions }}</flux:text>
            </div>
        </div>
        <div class="rounded-md border shadow">
            <div class="flex justify-between items-center p-4 h-24">
                <div>
                    <flux:heading size="sm">Programs</flux:heading>
                    <flux:text class="text-4xl font-semibold" variant="strong">{{ $programFollowed }}</flux:text>
                </div>
                <flux:avatar icon="clipboard-document-list" />
            </div>
            <flux:separator />
            <div class="p-4 flex justify-center">
                <flux:link :href="route('admin.members.index')" class="text-sm" wire:navigate>View details</flux:link>
            </div>
        </div>
        <div class="rounded-md border shadow">
            <div class="flex justify-between items-center p-4 h-24">
                <div>
                    <flux:heading size="sm">Investments</flux:heading>
                    <flux:text class="text-4xl font-semibold" variant="strong">
                        {{ number_format($investmentValue, '0', ',', '.') }}</flux:text>
                </div>
                <flux:avatar icon="chart-bar" />
            </div>
            <flux:separator />
            <div class="p-4 flex justify-center">
                <flux:link :href="route('admin.members.index')" class="text-sm" wire:navigate>View details</flux:link>
            </div>
        </div>
    </div>
    <div class="space-y-2">
        <flux:heading size="lg">Latest Transactions</flux:heading>
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
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @forelse ($transactions as $item)
                                <tr wire:key="transaction-{{ $item->id }}">
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{ Carbon\Carbon::parse($item->transaction_date)->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        {{ $item->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        {{ class_basename($item->transactionable_type) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        <span>{{ $item->transactionable->name ?? 'N/A' }}</span>
                                        @if ($item->transactionable_type == 'App\Models\Program')
                                            - <span class="capitalize">{{ $item->transaction_type }}</span>
                                        @endif
                                    </td>
                                    <td
                                        class="px-6 py-4 text-end whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        {{ number_format($item->amount, 0, ',', '.') }}
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
