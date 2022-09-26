<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

class EditTask extends Component
{
    public ?Task $editingTask;

    public $name;

    protected $listeners = [
        'editTask' => 'onEditTask',
    ];

    protected $rules = [
        'name' => 'required|string',
    ];

    public function render()
    {
        return view('livewire.edit-task');
    }

    public function onEditTask(Task $task)
    {
        $this->editingTask = $task;

        $this->name = $this->editingTask->name;
    }

    public function update()
    {
        $this->validate();

        if ($this->editingTask) {
            $this->editingTask->name = $this->name;
            $this->editingTask->save();

            $this->emit('taskUpdated', $this->editingTask->id);

            // Clear input data.
            $this->editingTask = null;
            $this->name = null;
        }
    }
}
