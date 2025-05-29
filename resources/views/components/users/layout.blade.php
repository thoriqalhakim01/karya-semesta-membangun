<div class="flex items-start max-md:flex-col">
    <div class="me-10 w-full pb-4 md:w-[220px]">
        <flux:navlist>
            <flux:navlist.item :href="route('admin.members.edit', $member)" wire:navigate>{{ __('Members') }}
            </flux:navlist.item>
            <flux:navlist.item :href="route('admin.members.edit-programs', $member)" wire:navigate>{{ __('Programs') }}
            </flux:navlist.item>
            <flux:navlist.item :href="route('admin.members.edit-investments', $member)" wire:navigate>
                {{ __('Investments') }}</flux:navlist.item>
        </flux:navlist>
    </div>

    <flux:separator class="md:hidden" />

    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading size="lg">{{ $heading ?? '' }}</flux:heading>
        <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>

        <div class="mt-5 w-full">
            {{ $slot }}
        </div>
    </div>
</div>
