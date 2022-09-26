<?php

namespace App\Http\Livewire;

use App\Enums\TaskStatus;
use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class Tasks extends Component
{
    use WithPagination;

    public $newTodo;
    public $selected = [];

    protected $listeners = [
        'taskAdded' => 'onTaskAdded',
        'taskUpdated' => '$refresh',
        'taskDeleted' => '$refresh',
        'bulkUpdated' => '$refresh',
    ];

    protected $rules = [
        'newTodo' => 'required|min:2',
    ];

    public function render()
    {
        $tasks = $this->query();

        $total = Task::count('id');

        return view('livewire.tasks', compact('total', 'tasks'));
    }

    public function query()
    {
        return Task::query()
            ->latest()
            ->cursorPaginate();
    }

    public function add(): void
    {
        $this->validate();

        (new Task())->forceFill([
            'user_id' => auth()->id(),
            'name' => $this->newTodo,
        ])->saveOrFail();

        $this->emit('taskAdded');
    }

    public function bulkUpdate(array $ids, string $status)
    {
        $status = TaskStatus::from($status);

        Task::query()
            ->whereIn('id', $ids)
            ->update(['status' => $status->value]);

        $this->emit('bulkUpdated', $ids, $status->value);
    }

    public function onTaskAdded(): void
    {
        $this->newTodo = null;
    }
}
