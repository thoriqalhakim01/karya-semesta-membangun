<section class="w-full space-y-6">
    @include('partials.users-heading')
    <x-users.layout :member="$member" :heading="__('Investments')" :subheading="__('Updates on investments that members are participating in')">
        <div class="w-full">
            <form action="">
                {{--  --}}
            </form>
        </div>
    </x-users.layout>
</section>
