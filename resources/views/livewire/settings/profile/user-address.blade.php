<div class="border rounded-md shadow p-4">
    <div class="flex flex-col gap-4">
        <div class="flex justify-between items-center">
            <flux:heading size="lg">Address Information</flux:heading>
            <livewire:settings.profile.edit-user-address />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <flux:text>Province</flux:text>
                <flux:text variant="strong" class="font-medium text-md">{{ $this->getProvinceName() ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:text>City</flux:text>
                <flux:text variant="strong" class="font-medium text-md">{{ $this->getCityName() ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:text>District</flux:text>
                <flux:text variant="strong" class="font-medium text-md capitalize">
                    {{ $this->getDistrictName() ?? '-' }}
                </flux:text>
            </div>
            <div>
                <flux:text>Village</flux:text>
                <flux:text variant="strong" class="font-medium text-md">
                    {{ $this->getVillageName() ?? '-' }}
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
