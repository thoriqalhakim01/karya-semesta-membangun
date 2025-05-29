<div class="relative w-full flex flex-col">
    <div class="flex justify-between items-start">
        <div>
            <flux:heading size="xl" level="1">{{ __('Edit Member') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">
                {{ __('Update profile information of member and programs or investments that members participate in') }}
            </flux:subheading>
        </div>
        <flux:button icon="x-mark" variant="outline" href="{{ route('admin.members.show', $member) }}">
            Cancel
        </flux:button>
    </div>
    <flux:separator variant="subtle" />
</div>
