<div class="border rounded-md shadow p-4">
    <div class="flex flex-col gap-4">
        <div class="flex justify-between items-center">
            <flux:heading size="lg">Personal Information</flux:heading>
            <livewire:settings.profile.edit-user-detail />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <flux:text>Birth Place</flux:text>
                <flux:text variant="strong" class="font-medium text-md">{{ $user->detail->birth_place ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:text>Birth Date</flux:text>
                <flux:text variant="strong" class="font-medium text-md">{{ $user->detail->birth_date ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:text>Gender</flux:text>
                <flux:text variant="strong" class="font-medium text-md capitalize">{{ $user->detail->gender ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:text>Married</flux:text>
                <flux:text variant="strong" class="font-medium text-md">
                    {{ $user->detail->is_married ? 'Married' : 'Not Married' }}
                </flux:text>
            </div>
            <div>
                <flux:text>Last Edecation</flux:text>
                <flux:text variant="strong" class="font-medium text-md">{{ $user->detail->last_education ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:text>Major</flux:text>
                <flux:text variant="strong" class="font-medium text-md">{{ $user->detail->major ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:text>Job</flux:text>
                <flux:text variant="strong" class="font-medium text-md">{{ $user->detail->job ?? '-' }}
                </flux:text>
            </div>
        </div>
    </div>
</div>
