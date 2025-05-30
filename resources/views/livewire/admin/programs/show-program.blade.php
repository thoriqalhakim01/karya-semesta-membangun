<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="flex flex-1 justify-between items-center">
        <div>
            <flux:heading size="xl">{{ $program->name }}</flux:heading>
            <flux:subheading>{{ $program->description }}</flux:subheading>
        </div>
        <div class="flex gap-4">
            <flux:dropdown align="end" position="bottom">
                <flux:button icon="funnel" variant="ghost">
                    Filter
                    @if ($selectedYear || $selectedMonth)
                        <span
                            class="ml-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-blue-600 rounded-full">
                            @if ($selectedMonth)
                                {{ Carbon\Carbon::create()->month((int) $selectedMonth)->translatedFormat('M') }}
                                {{ $selectedYear }}
                            @else
                                {{ $selectedYear }}
                            @endif
                        </span>
                    @endif
                </flux:button>

                <flux:menu class="w-64">
                    <div class="px-3 py-2 border-b">
                        <flux:field>
                            <flux:label>Year</flux:label>
                            <flux:select wire:model.live="selectedYear" placeholder="Select Year">
                                <flux:select.option value="">All Years</flux:select.option>
                                @foreach ($availableYears as $year)
                                    <flux:select.option value="{{ $year }}">{{ $year }}
                                    </flux:select.option>
                                @endforeach
                            </flux:select>
                        </flux:field>
                    </div>

                    @if ($selectedYear && count($availableMonths) > 0)
                        <div class="px-3 py-2 border-b">
                            <flux:field>
                                <flux:label>Month</flux:label>
                                <flux:select wire:model.live="selectedMonth" placeholder="Select Month">
                                    <flux:select.option value="">All Months</flux:select.option>
                                    @foreach ($availableMonths as $month)
                                        <flux:select.option value="{{ $month['value'] }}">{{ $month['label'] }}
                                        </flux:select.option>
                                    @endforeach
                                </flux:select>
                            </flux:field>
                        </div>
                    @endif

                    <div class="px-3 py-2">
                        <flux:button wire:click="resetFilters" variant="ghost" size="sm" class="w-full">
                            Reset Filters
                        </flux:button>
                    </div>
                </flux:menu>
            </flux:dropdown>

            <livewire:admin.programs.edit-program :program="$program" />
            <livewire:admin.programs.delete-program :program="$program" />
        </div>
    </div>

    <div class="border rounded-md shadow">
        <div class="p-4">
            <div class="mb-4 text-center">
                <flux:subheading class="text-gray-600">
                    @if ($selectedMonth && $selectedYear)
                        Statistics for {{ Carbon\Carbon::create()->month((int) $selectedMonth)->translatedFormat('F') }}
                        {{ $selectedYear }}
                    @elseif($selectedYear)
                        Statistics for {{ $selectedYear }}
                    @else
                        All Time Statistics
                    @endif
                </flux:subheading>
            </div>

            <div class="grid md:grid-cols-3 gap-4">
                <div class="rounded-md border shadow">
                    <div class="flex flex-col space-y-2 p-4">
                        <flux:heading size="lg" class="text-center">Target/member</flux:heading>
                        <p class="text-center text-2xl font-bold">{{ number_format($program->target, 0, ',', '.') }}
                        </p>
                        <p class="text-center text-xs text-gray-500">Program Target</p>
                    </div>
                </div>
                <div class="rounded-md border shadow">
                    <div class="flex flex-col space-y-2 p-4">
                        <flux:heading size="lg" class="text-center">Collected</flux:heading>
                        <p class="text-center text-2xl font-bold text-green-600">
                            {{ number_format($collected, 0, ',', '.') }}</p>
                        <p class="text-center text-xs text-gray-500">Program Collected</p>
                    </div>
                </div>
                <div class="rounded-md border shadow">
                    <div class="flex flex-col space-y-2 p-4">
                        <flux:heading size="lg" class="text-center">Participants</flux:heading>
                        <p class="text-center text-2xl font-bold text-blue-600">{{ $numberOfParticipants }}</p>
                        <p class="text-center text-xs text-gray-500">
                            @if ($selectedMonth || $selectedYear)
                                Active in period
                            @else
                                Total participants
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-between items-center">
        <flux:heading size="lg">Transactions</flux:heading>
        @if ($transactions->total() > 0)
            <div class="text-sm text-gray-500">
                Showing {{ $transactions->firstItem() }}-{{ $transactions->lastItem() }} of
                {{ $transactions->total() }} transactions
            </div>
        @endif
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
                                    @if ($selectedYear || $selectedMonth)
                                        No transactions found for the selected period.
                                        <button wire:click="resetFilters"
                                            class="text-blue-600 hover:text-blue-800 underline ml-1">
                                            Show all transactions
                                        </button>
                                    @else
                                        No transactions found for this program
                                    @endif
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
