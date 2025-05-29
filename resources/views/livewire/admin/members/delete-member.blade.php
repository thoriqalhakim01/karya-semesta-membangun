    <?php

    use Livewire\Volt\Component;

    new class extends Component {
        public $member;

        public function delete()
        {
            $this->member->delete();

            $this->redirect(route('admin.members.index'), navigate: true);
        }
    }; ?>

    <div>
        <flux:modal.trigger name="delete-member">
            <flux:button variant="danger" icon="trash">
                Delete
            </flux:button>
        </flux:modal.trigger>

        <flux:modal name="delete-member" focusable class="w-full max-w-xl space-y-8">
            <div>
                <flux:heading size="xl">Delete Member</flux:heading>
                <flux:subheading>
                    Are you sure you want to delete this member?
                </flux:subheading>
            </div>
            <form wire:submit="delete">
                <div class="flex justify-end gap-4">
                    <flux:modal.close>
                        <flux:button variant="outline">Cancel</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="danger">
                        Delete
                    </flux:button>
                </div>
            </form>
        </flux:modal>
    </div>
