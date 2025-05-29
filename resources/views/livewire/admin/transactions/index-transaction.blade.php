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
        <div class="flex justify-between items-center">
            <div class="lg:w-1/3">
                <flux:input wire:model.live="search" type="text" placeholder="Search Transaction" />
            </div>
            <div class="flex gap-2">
                <flux:button icon="funnel" variant="ghost">
                    Filter
                </flux:button>
                <flux:button icon="bars-arrow-down" variant="ghost">
                    Sort
                </flux:button>
            </div>
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
                                <tr>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        29 May 2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        Thoriq Al Hakim</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        Program</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        Investment</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        100.000</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex justify-end">
                                        <flux:button variant="ghost" size="sm">
                                            <flux:icon.pencil-square class="text-green-500 size-5" />
                                        </flux:button>
                                        <flux:button variant="ghost" size="sm" >
                                            <flux:icon.trash class="text-red-500 size-5" />
                                        </flux:button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
