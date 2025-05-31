<div class="border rounded-md shadow p-4">
    <div class="flex flex-col gap-4">
        <div class="flex justify-between items-center">
            <flux:heading size="lg">Address Information</flux:heading>
            <livewire:settings.profile.edit-user-address />
        </div>
        <div class="space-y-2">
            <div>
                <flux:text>Type</flux:text>
                <flux:text variant="strong" class="font-medium text-md capitalize">{{ $type ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:text>Address</flux:text>
                <flux:text variant="strong" class="font-medium text-md capitalize">
                    {{ $fullAddress ?? '-' }}
                </flux:text>
            </div>
        </div>
    </div>
</div>
