    <?php

    use Livewire\Volt\Component;

    new class extends Component {
        public $program;

        public function delete()
        {
            $this->program->delete();

            $this->redirect(route('admin.programs.index'), navigate: true);
        }
    }; ?>

    <div>
        <flux:modal.trigger name="delete-program">
            <flux:button variant="danger" icon="trash">
                Delete
            </flux:button>
        </flux:modal.trigger>

        <flux:modal name="delete-program" focusable class="w-full max-w-xl space-y-8">
            <div>
                <flux:heading size="xl">Delete Program</flux:heading>
                <flux:subheading>
                    Are you sure you want to delete this program?
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
