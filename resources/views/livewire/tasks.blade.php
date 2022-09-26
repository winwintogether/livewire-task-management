<div class="max-w-4xl mx-auto">
    <div class="form-control w-full">
        <label for="new-todo" class="label sr-only">Add new</label>
        <input
            wire:model.defer="newTodo"
            wire:keydown.enter="add()"
            class="input w-full @error('newTodo') input-error @enderror"
            type="text"
            name="new-todo"
            id="new-todo"
            placeholder="Whats need to be done?"
            autofocus
            required
        />

        @error('newTodo')
        <span class="text-sm text-error block pt-2">{{ $message }}</span>
        @enderror
    </div>

    <div
        x-data="tasksComponent()"
        id="tasks"
        class="mt-12"
    >
        <header class="flex items-center justify-between mb-4">
            <h2 class="inline-flex gap-2 items-center font-semibold text-2xl text-gray-800 leading-tight">
                <span>Tasks</span>
                <span class="badge">{{ $total ?? 0 }}</span>
            </h2>

            <div class="flex justify-center items-center gap-4">
                <div class="dropdown dropdown-end">
                    <button
                        :disabled="selected.length === 0"
                        tabindex="0"
                        class="btn btn-sm btn-ghost btn-accent m-1"
                    >
                        <span x-text="selected.length"></span>
                        <span>&nbsp; Selected</span>
                    </button>

                    <ul
                        tabindex="0"
                        class="dropdown-content menu p-2 shadow bg-base-100 rounded-lg w-52"
                        x-show="selected.length > 0"
                    >
                        <li>
                            <a @click="bulkUpdate('pending')">Pending</a>
                        </li>
                        <li>
                            <a @click="bulkUpdate('busy')">Busy</a>
                        </li>

                        <li>
                            <a @click="bulkUpdate('done')">Done</a>
                        </li>
                    </ul>
                </div>

                <button
                    type="button"
                    class="btn btn-white btn-sm btn-circle"
                    wire:click="$refresh"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                    </svg>
                </button>
            </div>
        </header>

        <div class="relative z-10">
            <div wire:loading>
                <div class="absolute z-20 bg-white/50 inset-0 flex items-center justify-center">
                    <span>Loading...</span>
                </div>
            </div>

            <ul class="flex flex-col gap-4 mb-12">
                @foreach($tasks as $task)
                    <li>
                        <livewire:task-item :task="$task" :wire:key="time() . $task->id" />
                    </li>
                @endforeach
            </ul>
        </div>

        {{ $tasks->links() }}
    </div>

    <livewire:edit-task />

    <script>
        function tasksComponent() {
            return {
                selected: [],

                async bulkUpdate(status) {
                    await this.$wire.bulkUpdate(this.selected, status);

                    this.selected = [];
                },
            };
        }
    </script>
</div>
