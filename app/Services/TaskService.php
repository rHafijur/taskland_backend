<?php

namespace App\Services;

use Carbon\Carbon;
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
        return $this->taskRepository->create($data);
    }

    public function update(array $data, $id)
    {
        $data['due_date'] = Carbon::parse($data['due_date'])->format('Y-m-d H:i:s');
        return $this->taskRepository->update($data, $id);
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
        return $this->taskRepository->complete($id);
    }
}
