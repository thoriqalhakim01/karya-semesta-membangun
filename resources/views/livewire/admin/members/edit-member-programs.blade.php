<section class="w-full space-y-6">
    @include('partials.users-heading')
    <x-users.layout :member="$member" :heading="__('Programs')" :subheading="__('Updates on programs that members are participating in')">
        <div class="w-full">
           <form wire:submit="save" class="space-y-4">
            @foreach ($form->programs as $index => $program)
                <div class="flex gap-2">
                    <flux:select class="w-full" placeholder="Choose program..." wire:model="form.programs.{{ $index }}">
                        @foreach ($programList as $program )
                            <flux:select.option value="{{ $program->id }}">{{ $program->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    @if ($index < count($form->programs) - 1)
                        <flux:button icon="minus" type="button" variant="danger" wire:click="removeProgramRow({{ $index }})">
                        </flux:button>
                    @endif
                </div>
            @endforeach
            <div class="flex justify-end">
                <flux:button icon="plus" type="button" variant="primary" wire:click="addProgramRow"></flux:button>
            </div>
            <div class="flex justify-end mt-6">
                    <flux:button type="submit" variant="primary">
                        Save Changes
                    </flux:button>
                </div>
           </form>
        </div>
    </x-users.layout>
</section>
