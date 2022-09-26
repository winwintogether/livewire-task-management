<div>
    <div
        id="edit-task"
        class="modal modal-bottom sm:modal-middle"
        x-data="editTask()"
        :class="{ 'modal-open': open }"
    >
        <div class="modal-box relative">
            <label
                for="edit-task"
                class="btn btn-sm btn-circle absolute right-2 top-2"
                @click.prevent="open = false"
            >✕</label>

            <h3 class="font-bold text-lg">Edit Task</h3>

            @if($editingTask)
                <div class="py-4">
                    <div class="form-control w-full">
                        <label for="edit-name" class="label">Name</label>
                        <input
                            wire:model.defer="name"
                            type="text"
                            class="input input-bordered w-full @error('name') input-error @enderror"
                            name="name"
                            id="edit-name"
                            value="{{ $editingTask->name }}"
                            placeholder=""
                            required
                        />

                        @error('name')
                            <span class="text-sm text-error block pt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endif

            <div class="modal-action">
                <button class="btn" wire:click="update">Save</button>
            </div>
        </div>
    </div>

    <script>
        function editTask() {
            return {
                open: false,

                init() {
                    Livewire.on('editTask', () => this.open = true);
                    Livewire.on('taskUpdated', () => this.open = false);
                },
            };
        }
    </script>
</div>
