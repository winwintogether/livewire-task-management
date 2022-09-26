<?php

namespace App\Http\Livewire;

use App\Enums\TaskStatus;
use App\Models\Task;
use Livewire\Component;

class TaskItem extends Component
{
    public Task $task;

    public function render()
    {
        return view('livewire.task-item');
    }

    public function updateStatus(string $status)
    {
        $this->task->status = TaskStatus::from($status);
        $this->task->save();
    }

    public function delete(): void
    {
        $deleted = $this->task->delete();

        if ($deleted) {
            $this->emit('taskDeleted');
        }
    }
}
