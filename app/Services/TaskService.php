<?php

namespace App\Services;

use Carbon\Carbon;
use App\Events\TaskUpdated;
use App\Events\TaskCompleted;
use App\Repositories\TaskRepositoryInterface;

class TaskService
{
    public function __construct(
        protected TaskRepositoryInterface $taskRepository
    ) {
    }

    public function create(array $data)
    {
        $data['task_status_id'] = 1;
        $data['due_date'] = Carbon::parse($data['due_date'])->format('Y-m-d');
        $task = $this->taskRepository->create($data);
        try {
            TaskUpdated::dispatch($task['id']);
        } catch(\Throwable $t) {
        }
        return $task;
    }

    public function update(array $data, $id)
    {
        $data['due_date'] = Carbon::parse($data['due_date'])->format('Y-m-d H:i:s');
        $task = $this->taskRepository->update($data, $id);
        try {
            TaskUpdated::dispatch($task['id']);
        } catch(\Throwable $t) {
        }
        return $task;
    }

    public function delete($id)
    {
        return $this->taskRepository->delete($id);
    }

    public function all()
    {
        return $this->taskRepository->all();
    }

    public function find($id)
    {
        return $this->taskRepository->find($id);
    }

    public function complete($id)
    {
        $task = $this->taskRepository->complete($id);
        try {
            TaskCompleted::dispatch($id);
        } catch(\Throwable $t) {
        }
        return $task;
    }
}
