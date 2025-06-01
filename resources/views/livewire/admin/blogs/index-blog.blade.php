<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="flex flex-1 justify-between items-center">
        <flux:heading size="xl">Blog Listing</flux:heading>
        <flux:button href="{{ route('admin.blogs.create') }}" icon="plus" variant="primary">
            <span class="hidden lg:block">Create New</span>
        </flux:button>
    </div>

    <div class="flex flex-1 flex-col gap-4">
        <div class="flex gap-2 items-center">
            <div class="lg:w-1/3">
                <flux:input wire:model.live.debounce.300ms="search" type="text" placeholder="Search Transaction" />
            </div>
            {{-- <flux:dropdown align="start" position="bottom">
                <flux:button icon="funnel" variant="ghost">
                    Filter
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
            </flux:dropdown> --}}
        </div>
        <div>
            <div class="flex flex-col">
                <div wire:loading.delay.longer
                    wire:target="search, transactionableType, startDate, endDate, programType"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <div class="flex items-center space-x-2">
                            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                            <span>Loading blogs...</span>
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
                                        Date</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Title</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Thumbnail</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Category</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 dark:text-neutral-400">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse ($blogs as $item)
                                    <tr wire:key="transaction-{{ $item->id }}">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{--  --}}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{--  --}}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{--  --}}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{--  --}}
                                        </td>
                                        <td
                                            class="px-6 py-4 text-end whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{--  --}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap flex justify-end">
                                            {{--  --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-6 py-4 text-center text-sm text-gray-500 dark:text-neutral-400">
                                            No blogs found
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
