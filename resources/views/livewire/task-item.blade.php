<div
    class="group card card-compact overflow-visible w-full bg-base-100 transition-all rounded-lg shadow-sm hover:shadow-md"
    :class="{ 'ring ring-accent/50': selected.includes({{ $task->id }}) }"
>
    <div class="card-body relative">
        <div class="flex items-center w-full gap-4">
            <div class="form-control shrink-0 border-r border-r-gray-200 pr-4">
                <input
                    type="checkbox"
                    name="selected"
                    class="checkbox rounded-full border-2 checked:checkbox-accent !bg-none"
                    value="{{ $task->id }}"
                    x-model.number="selected"
                />
            </div>

            <div class="dropdown">
                <label
                    tabindex="0"
                    class="cursor-pointer badge
                        {{ match ($task->status) {
                            \App\Enums\TaskStatus::PENDING => 'badge-warning',
                            \App\Enums\TaskStatus::BUSY => 'badge-neutral',
                            \App\Enums\TaskStatus::DONE => 'badge-success',
                        } }}
                    "
                >
                    {{ $task->status?->label() }}
                </label>

                <ul tabindex="0" class="dropdown-content menu mt-1 p-1 shadow bg-base-100 rounded w-52">
                    @foreach(\App\Enums\TaskStatus::cases() as $case)
                        <li>
                            <a wire:click.prevent="updateStatus('{{ $case->value }}')">
                                {{ $case->label() }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <h2 class="text-base font-semibold leading-normal {{ $task->status?->isDone() ? 'line-through text-gray-500' : '' }}">
                {{ $task->name }}
            </h2>
        </div>

        <div class="flex items-center gap-4 pl-14 text-sm text-gray-400 pt-2">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock mr-1" viewBox="0 0 16 16">
                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                </svg>

                <span>{{ $task->created_at?->toDayDateTimeString() }}</span>
            </div>

            <div>
                <a
                    href="#"
                    wire:click.prevent="$emit('editTask', {{ $task->id }})"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square mr-1" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>

                    <span>Edit</span>
                </a>
            </div>
        </div>

        <div class="card-actions absolute right-2 top-2 hidden group-hover:inline-flex">
            <button
                type="button"
                class="btn btn-link btn-circle btn-sm hover:bg-gray-100"
                wire:click.prevent="delete"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>
