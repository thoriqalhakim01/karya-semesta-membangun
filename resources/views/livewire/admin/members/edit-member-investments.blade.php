<section class="w-full space-y-6">
    @include('partials.users-heading')
    <x-users.layout :member="$member" :heading="__('Investments')" :subheading="__('Updates on investments that members are participating in')">
        <div class="w-full">
            <form wire:submit="save" class="space-y-4">
            @foreach ($form->investments as $index => $investment)
                <div class="flex gap-2">
                    <flux:select class="w-full" placeholder="Choose investment..." wire:model="form.investments.{{ $index }}">
                        @foreach ($investmentList as $investment )
                            <flux:select.option value="{{ $investment->id }}">{{ $investment->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    @if ($index < count($form->investments) - 1)
                        <flux:button icon="minus" type="button" variant="danger" wire:click="removeInvestmentRow({{ $index }})">
                        </flux:button>
                    @endif
                </div>
            @endforeach
            <div class="flex justify-end">
                <flux:button icon="plus" type="button" variant="primary" wire:click="addInvestmentRow"></flux:button>
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
