<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    private function mapper($task)
    {
        return [
            'id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
            'due_date' => $task->due_date,
            'project_title' => $task->project->title,
            'project_id' => $task->project->id,
            'priority' => $task->priority->title,
            'priority_id' => $task->priority->id,
            'task_status' => $task->status->title,
            'task_status_id' => $task->status->id,
            'completed_at' => $task->completed_at,
            'creator_name' => $task->createdBy->name
        ];
    }

    // public function all()
    // {
    //     return Task::all()->map(function ($task) {
    //         return $this->mapper($task);
    //     });
    // }

    public function all()
    {
        return Task::where('created_by', auth()->id())->get()->map(function ($task) {
            return $this->mapper($task);
        });
    }

    public function create(array $data)
    {
        return $this->mapper(Task::create($data));
    }

    public function update(array $data, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $this->mapper($task);
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }

    public function find($id)
    {
        return Task::findOrFail($id);
    }

    public function complete($id)
    {
        $task = Task::findOrFail($id);
        $task->completed_at = Carbon::now();
        $task->task_status_id = 2;
        $task->save();
        return $this->mapper($task);
    }
}
