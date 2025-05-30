<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="flex flex-1 justify-between items-center">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('admin.members.index') }}">
                Members
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                {{ $member->name }}
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="flex items-center gap-x-4">
                <flux:button icon="pencil-square" variant="outline" href="{{ route('admin.members.edit', $member->id) }}"
                wire:navigate>
                Edit
            </flux:button>
            <livewire:admin.members.delete-member :member="$member" />
        </div>
    </div>
    <div class="grid lg:grid-cols-2 gap-6">
        @include('livewire.admin.members.member-details')
        @include('livewire.admin.members.program-investment')
    </div>
</div>
