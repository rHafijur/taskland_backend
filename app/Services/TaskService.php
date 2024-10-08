<?php

namespace App\Services;

use Carbon\Carbon;
use App\Events\TaskUpdated;
use App\Events\TaskCompleted;
use App\Filters\CreatedByFilter;
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
        $data['due_date'] = Carbon::parse($data['due_date'])->addHours(23)->addMinutes(59)->addSeconds(59);
        $task = $this->taskRepository->create($data);
        try {
            TaskUpdated::dispatch($task['id']);
        } catch(\Throwable $t) {
        }
        return $task;
    }

    public function update(array $data, $id)
    {
        // $data['due_date'] = Carbon::parse($data['due_date'])->addHours(23)->addMinutes(59)->addSeconds(59);
        $task = $this->taskRepository->update($data, $id);
        try {
            TaskUpdated::dispatch($task['id']);
        } catch(\Throwable $t) {
        }
        return $task;
    }

    public function delete($id)
    {
        $this->taskRepository->delete($id);
        try {
            TaskUpdated::dispatch($id);
        } catch(\Throwable $t) {
        }
        return;
    }

    public function all()
    {
        return $this->taskRepository->all();
    }

    public function allByAuthUser()
    {
        return $this->taskRepository->all(filters: [new CreatedByFilter(auth()->id())]);
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
