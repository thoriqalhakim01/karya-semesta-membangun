<div class="flex flex-col gap-4">
    <flux:avatar name="{{ $member->name }}" />
    <flux:heading size="xl">{{ $member->name }}</flux:heading>
    <div class="border rounded-md p-4 flex flex-col gap-2">
        <flux:heading size="lg">Contacts</flux:heading>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <flux:heading class="base">Email</flux:heading>
                <flux:text>{{ $member->email }}</flux:text>
            </div>
            <div>
                <flux:heading class="base">Phone Number</flux:heading>
                <flux:text>{{ $member->phone }}</flux:text>
            </div>
        </div>
    </div>
    <div class="border rounded-md p-4 flex flex-col gap-2">
        <flux:heading size="lg">Details</flux:heading>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <flux:heading class="base">Birth Place</flux:heading>
                <flux:text>{{ $member->detail->birth_place ?? '-' }}</flux:text>
            </div>
            <div>
                <flux:heading class="base">Birth Date</flux:heading>
                <flux:text>{{ $member->detail->birth_date ?? '-' }}</flux:text>
            </div>
            <div>
                <flux:heading class="base">Gender</flux:heading>
                <flux:text class="capitalize">{{ $member->detail->gender ?? '-' }}</flux:text>
            </div>
            <div>
                <flux:heading class="base">Married</flux:heading>
                <flux:text>{{ $member->detail->is_married ? 'Married' : 'Not Married' }}</flux:text>
            </div>
            <div>
                <flux:heading class="base">Last Edecation</flux:heading>
                <flux:text>{{ $member->detail->last_education ?? '-' }}</flux:text>
            </div>
            <div>
                <flux:heading class="base">Major</flux:heading>
                <flux:text>{{ $member->detail->major ?? '-' }}</flux:text>
            </div>
            <div>
                <flux:heading class="base">Job</flux:heading>
                <flux:text>{{ $member->detail->job ?? '-' }}</flux:text>
            </div>
        </div>
    </div>
</div>
