<div class="border rounded-md shadow p-4">
    <div class="flex flex-col gap-4">
        <div class="flex justify-between items-center">
            <flux:heading size="lg">Bank Account Information</flux:heading>
            <livewire:settings.profile.edit-bank-account />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <flux:text>BTN Account Number</flux:text>
            <flux:text variant="strong" class="font-medium text-md">
                {{ $user->detail->btn_account_number ?? '-' }}
            </flux:text>
            <flux:text>Mandiri Account Number</flux:text>
            <flux:text variant="strong" class="font-medium text-md">
                {{ $user->detail->mandiri_account_number ?? '-' }}
            </flux:text>
        </div>
    </div>
</div>
