<div class="border rounded-md shadow p-4">
    <div class="flex flex-col gap-4">
        <div class="flex justify-between items-center">
            <flux:heading size="lg">Family Information</flux:heading>
            <livewire:settings.profile.edit-user-family />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <flux:text>Father Name</flux:text>
                <flux:text variant="strong" class="font-medium text-md">{{ $user->family->father_name ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:text>Mother Name</flux:text>
                <flux:text variant="strong" class="font-medium text-md">{{ $user->family->mother_name ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:text>Family Status</flux:text>
                <flux:text variant="strong" class="font-medium text-md capitalize">
                    {{ $user->family->family_status ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:text>Number of Children</flux:text>
                <flux:text variant="strong" class="font-medium text-md">
                    {{ $user->family->number_of_children ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:text>Residential Ownership</flux:text>
                <flux:text variant="strong" class="font-medium text-md capitalize">
                    {{ $user->family->residential_ownership ?? '-' }}
                </flux:text>
            </div>
        </div>
    </div>
</div>
