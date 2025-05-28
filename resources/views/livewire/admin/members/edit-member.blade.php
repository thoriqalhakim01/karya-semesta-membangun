<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="flex flex-1 justify-between items-start">
        <flux:heading size="xl">Edit Member</flux:heading>
        <flux:button icon="x-mark" variant="outline" href="{{ route('admin.members.show', $member->id) }}">
            Cancel
        </flux:button>
    </div>
</div>
