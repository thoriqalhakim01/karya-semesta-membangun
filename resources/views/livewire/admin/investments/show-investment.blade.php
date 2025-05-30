<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="flex flex-1 justify-between items-center">
        <div>
            <flux:heading size="xl">{{ $investment->name }}</flux:heading>
        </div>
        <div class="flex gap-4">
            <livewire:admin.investments.edit-investment :investment="$investment" />
            <livewire:admin.investments.delete-investment :investment="$investment" />
        </div>
    </div>
    <div class="border rounded-md shadow">
        <div class="w-full overflow-auto p-4 grid md:grid-cols-3 gap-4">
            <div class="rounded-md border shadow">
                <div class="flex flex-col space-y-2 p-4">
                    <flux:heading size="lg" class="text-center">Collected</flux:heading>
                    <p class="text-center text-2xl font-bold text-green-600">
                        {{ number_format($collected, 0, ',', '.') }}</p>
                    <p class="text-center text-xs text-gray-500">
                        Investment Collected
                    </p>
                </div>
            </div>
            <div class="rounded-md border shadow">
                <div class="flex flex-col space-y-2 p-4">
                    <flux:heading size="lg" class="text-center">Number of Participants</flux:heading>
                    <p class="text-center text-2xl font-bold text-blue-600">{{ $numberOfParticipants }}</p>
                    <p class="text-center text-xs text-gray-500">
                        Total participants
                    </p>
                </div>
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
                                <td colspan="5"
                                    class="px-6 py-4 text-center text-sm text-gray-500 dark:text-neutral-400">
                                    No transactions found for this investment
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if ($transactions->hasPages())
        <div class="mt-4">
            {{ $transactions->links() }}
        </div>
    @endif
</div>
