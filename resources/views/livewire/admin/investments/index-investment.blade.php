<div class="flex w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="flex flex-1 justify-between items-center">
        <flux:heading size="xl">Investment Listing</flux:heading>
        <livewire:admin.investments.create-investment />
    </div>
    <div class="flex flex-1 flex-col gap-4">
        <div class="w-1/3">
            <flux:input wire:model.live="search" type="text" placeholder="Search Investment" />
        </div>
        <div class="border rounded-md shadow">
            <div class="w-full overflow-auto p-4 grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                @forelse ($investments as $investment)
                    <a href="{{ route('admin.investments.show', $investment) }}" class="group">
                        <div class="rounded-md border shadow hover:bg-accent/10 hover:shadow-accent/20">
                            <div class="flex flex-col p-4">
                                <flux:heading size="lg">{{ $investment->name }}</flux:heading>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center">
                        <flux:subheading>No investments found</flux:subheading>
                    </div>
                @endforelse
            </div>
        </div>
        {{ $investments->links() }}
    </div>
</div>
