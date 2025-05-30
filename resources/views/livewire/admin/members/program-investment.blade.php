<div class="flex flex-col gap-4">
    <div class="space-y-2">
        <flux:heading size="lg">Program</flux:heading>
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start font-medium uppercase">
                                        <flux:text class="text-xs">Name</flux:text>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start font-medium uppercase">
                                        <flux:text class="text-xs">Target</flux:text>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start font-medium uppercase">
                                        <flux:text class="text-xs">Collected</flux:text>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse ($member->programs as $program)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <flux:text variant="strong">{{ $program->name }}</flux:text>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <flux:text variant="strong">
                                                {{ number_format($program->target, 0, ',', '.') }}</flux:text>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <flux:text variant="strong">
                                                {{ number_format($this->getCollectedAmountProgram($program), 0, ',', '.') }}
                                            </flux:text>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4">
                                            <flux:text>No program found</flux:text>
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
    <div class="space-y-2">
        <flux:heading size="lg">Investment</flux:heading>
        <div class="grid grid-cols-2 gap-4">
            @forelse ($member->investments as $investment)
                <div class="rounded-md border shadow">
                    <div class="flex flex-col p-2 space-y-2">
                        <flux:heading size="lg">{{ $investment->name }}</flux:heading>
                        <div class="flex justify-between items-center">
                            <flux:text>
                                Collected:
                            </flux:text>
                            <flux:text variant="strong">
                                {{ number_format($this->getCollectedAmountInvestment($investment), 0, ',', '.') }}
                            </flux:text>
                        </div>
                    </div>
                </div>
            @empty
                <flux:text>No investment found</flux:text>
            @endforelse
        </div>
    </div>
</div>
