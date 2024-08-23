<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function all()
    {
        return Task::all();
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update(array $data, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
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
}
