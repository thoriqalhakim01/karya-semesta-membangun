<div class="border rounded-md shadow p-4">
    <div class="flex flex-col gap-4">
        <div class="flex justify-between items-center">
            <flux:heading size="lg">Family Information</flux:heading>
            <flux:button variant="outline" icon="pencil-square" wire:click="edit">
                Edit
            </flux:button>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <flux:text>Father Name</flux:text>
                <flux:text variant="strong" class="font-medium text-md">{{ $user->detail->birth_place ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:text>Mother Name</flux:text>
                <flux:text variant="strong" class="font-medium text-md">{{ $user->detail->birth_date ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:text>Family Status</flux:text>
                <flux:text variant="strong" class="font-medium text-md capitalize">{{ $user->detail->gender ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:text>Number of Children</flux:text>
                <flux:text variant="strong" class="font-medium text-md">
                    {{ $user->detail->birth_place ? 'Married' : 'Not Married' }}
                </flux:text>
            </div>
            <div>
                <flux:text>Residence Ownership</flux:text>
                <flux:text variant="strong" class="font-medium text-md">{{ $user->detail->last_education ?? '-' }}
                </flux:text>
            </div>
        </div>
    </div>
</div>
