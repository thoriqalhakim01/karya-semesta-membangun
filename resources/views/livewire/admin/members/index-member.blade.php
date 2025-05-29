<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="flex flex-1 justify-between items-center">
        <flux:heading size="xl">Member Listing</flux:heading>
        <flux:button icon="plus" variant="primary" href="{{ route('admin.members.create') }}">
            Add Member
        </flux:button>
    </div>
    <div class="flex flex-1 flex-col gap-4">
        <div class="lg:w-1/3">
            <flux:input wire:model.live="search" type="text" placeholder="Search Member" />
        </div>
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border border-gray-200 shadow rounded-lg overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium uppercase">
                                        Name</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium uppercase">
                                        Email</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium uppercase">
                                        Phone Number</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase">
                                        Programs</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase">
                                        Investments</th>
                                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium uppercase">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($members as $member)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center gap-x-2">
                                                <flux:avatar name="{{ $member->name }}" initials:single />
                                                <div class="flex flex-col">
                                                    <p class="font-medium">{{ $member->name }}</p>
                                                    <div class="flex items-center gap-x-2">
                                                        <flux:text class="text-xs">
                                                            {{ $member->gender == 'male' ? 'Male' : 'Female' }}</flux:text>
                                                        <flux:icon name="minus" class="w-2 h-2" />
                                                        <flux:text class="text-xs">
                                                            {{ (int) Carbon\Carbon::parse($member->detail->birth_date)->diffInYears(now()) }}
                                                            years old</flux:text>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ $member->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ $member->phone ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <flux:badge color="green" size="sm">{{ $member->programs->count() }}
                                            </flux:badge>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <flux:badge color="blue" size="sm">
                                                {{ $member->investments->count() }}</flux:badge>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <a href="{{ route('admin.members.show', $member->id) }}" wire:navigate>
                                                <flux:button size="sm" variant="ghost" class="cursor-pointer">
                                                    <flux:icon name="ellipsis-vertical" class="w-4 h-4" />
                                                </flux:button>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            No data found
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
