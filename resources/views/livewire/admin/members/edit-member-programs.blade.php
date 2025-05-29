<section class="w-full space-y-6">
    @include('partials.users-heading')
    <x-users.layout :member="$member" :heading="__('Programs')" :subheading="__('Updates on programs that members are participating in')">
        <div class="w-full">
            {{--  --}}
        </div>
    </x-users.layout>
</section>
