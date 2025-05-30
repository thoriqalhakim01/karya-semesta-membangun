<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="flex flex-1 flex-col">
        <flux:heading size="xl">Program Listing</flux:heading>
        <flux:text class="text-sm">Here are the programs you're currently following</flux:text>
    </div>
    <div class="flex flex-1 flex-col gap-4">
        <div class="w-1/3">
            <flux:input wire:model.live="search" type="text" placeholder="Search Program" />
        </div>
        <div class="border rounded-md shadow">
            <div class="w-full overflow-auto p-4 grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                @forelse ($programs as $program)
                    <a href="{{ route('admin.programs.show', $program) }}" class="group">
                        <div class="rounded-md border shadow hover:bg-accent/10 hover:shadow-accent/20">
                            <div class="flex flex-col p-4">
                                <flux:heading size="lg">{{ $program->name }}</flux:heading>
                                <flux:subheading>{{ $program->description }}</flux:subheading>
                            </div>
                            <div class="p-4 pt-0 flex justify-between items-center">
                                <p class="text-sm text-neutral-500">Target:</p>
                                <p class="text-sm font-semibold">{{ number_format($program->target, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center">
                        <flux:subheading>No programs found</flux:subheading>
                    </div>
                @endforelse
            </div>
        </div>
        {{ $programs->links() }}
    </div>
</div>
