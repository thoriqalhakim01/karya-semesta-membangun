<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="flex flex-1 justify-between items-start">
        <flux:heading size="xl">Add Member</flux:heading>
        <flux:button icon="x-mark" variant="outline" href="{{ route('admin.members.index') }}">
            Cancel
        </flux:button>
    </div>
    <flux:separator class="my-4" />

    @include('livewire.admin.members.stepper', ['currentStep' => $currentStep])

    <div class="flex-1">
        @include('livewire.admin.members.multi-step-form')
    </div>
</div>
