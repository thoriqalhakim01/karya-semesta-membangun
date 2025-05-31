<div>
    <flux:modal.trigger name="edit-user-address">
        <flux:button variant="outline" size="sm" icon="pencil-square" class="cursor-pointer">
            Edit
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-user-address" focusable class="w-full max-w-xl space-y-8">
        <div>
            <flux:heading size="xl">Edit Address Information</flux:heading>
            <flux:subheading>
                Let's fill out the form below to edit your address information.
            </flux:subheading>
        </div>
        <form wire:submit="save" class="space-y-6">
            <flux:select wire:model.live="province" placeholder="Choose province..." label="Province">
                @foreach ($provinceList as $provinceItem)
                    <flux:select.option value="{{ $provinceItem['id'] }}">{{ $provinceItem['name'] }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            @if ($province && count($cityList) > 0)
                <flux:select wire:model.live="city" placeholder="Choose city..." label="City">
                    @foreach ($cityList as $cityItem)
                        <flux:select.option value="{{ $cityItem['id'] }}">{{ $cityItem['name'] }}</flux:select.option>
                    @endforeach
                </flux:select>
            @endif

            @if ($city && count($districtList) > 0)
                <flux:select wire:model.live="district" placeholder="Choose district..." label="District">
                    @foreach ($districtList as $districtItem)
                        <flux:select.option value="{{ $districtItem['id'] }}">{{ $districtItem['name'] }}
                        </flux:select.option>
                    @endforeach
                </flux:select>
            @endif

            @if ($district && count($villageList) > 0)
                <flux:select wire:model.live="village" placeholder="Choose village..." label="Village">
                    @foreach ($villageList as $villageItem)
                        <flux:select.option value="{{ $villageItem['id'] }}">{{ $villageItem['name'] }}
                        </flux:select.option>
                    @endforeach
                </flux:select>
            @endif

            @if ($village)
                <flux:input wire:model="fullAddress" label="Address" placeholder="e.g. Jl. Raya No. 123" />
            @endif

            <div class="flex justify-end mt-6">
                <flux:button type="submit" variant="primary">
                    Save Changes
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
