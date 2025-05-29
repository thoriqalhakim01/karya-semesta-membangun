<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="flex flex-1 justify-between items-center">
        <div>
            <flux:heading size="xl">{{ $program->name }}</flux:heading>
            <flux:subheading>{{ $program->description }}</flux:subheading>
        </div>
        <div class="flex gap-4">
            <livewire:admin.programs.edit-program :program="$program" />
            <livewire:admin.programs.delete-program :program="$program" />
        </div>
    </div>
    <div class="border rounded-md shadow">
        <div class="w-full overflow-auto p-4 grid md:grid-cols-3 gap-4">
            <div class="rounded-md border shadow">
                <div class="flex flex-col space-y-2 p-4">
                    <flux:heading size="lg" class="text-center">Target</flux:heading>
                    <p class="text-center text-2xl font-bold">{{ number_format($program->target, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="rounded-md border shadow">
                <div class="flex flex-col space-y-2 p-4">
                    <flux:heading size="lg" class="text-center">Collected</flux:heading>
                    <p class="text-center text-2xl font-bold"></p>
                </div>
            </div>
            <div class="rounded-md border shadow">
                <div class="flex flex-col space-y-2 p-4">
                    <flux:heading size="lg" class="text-center">Number of Participants</flux:heading>
                    <p class="text-center text-2xl font-bold">{{ $numberOfParticipants }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
