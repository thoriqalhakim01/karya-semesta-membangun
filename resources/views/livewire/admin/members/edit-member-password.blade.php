<section class="w-full space-y-6">
    @include('partials.users-heading')
    <x-users.layout :member="$member" :heading="__('Credentials')" :subheading="__('Update member password')">
        <div class="w-full">
            <form wire:submit="save" class="space-y-4">
                <flux:input wire:model="password" type="password" label="Password" placeholder="Password" />
                <flux:input wire:model="password_confirmation" type="password" label="Confirm Password"
                    placeholder="Confirm Password" />
                <div class="flex justify-end mt-6">
                    <flux:button type="submit" variant="primary">
                        Save Changes
                    </flux:button>
                </div>
            </form>
        </div>
    </x-users.layout>
</section>
