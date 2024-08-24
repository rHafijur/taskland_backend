<?php

namespace App\Services;

use Carbon\Carbon;
use App\Filters\CreatedByFilter;
use App\Filters\UpcomingDeadlineFilter;
use App\Repositories\TaskRepositoryInterface;

class DashboardService
{
    public function __construct(
        protected TaskRepositoryInterface $taskRepository
    ) {
    }

    private function getTasks()
    {
        if(auth()->user()->role_id == 1) {
            return $this->taskRepository->all();
        }
        return $this->taskRepository->all(filters: [new CreatedByFilter(auth()->id())]);
    }

    public function allTasks()
    {
        return $this->getTasks();
    }

    private function dueToday()
    {
        $filters[] = new UpcomingDeadlineFilter(Carbon::now()->addDay());
        if(auth()->user()->role_id != 1) {
            $filters[] = new CreatedByFilter(auth()->id());
        }
        return $this->taskRepository->all(filters: $filters);
    }

    public function upcomingDeadlineTasks()
    {
        $filters = [];

        if(auth()->user()->role_id != 1) {
            $filters[] = new CreatedByFilter(auth()->id());
        }
        $tasks = $this->taskRepository->all(additionalQuery: function ($q) {
            return $q->where('due_date', '>=', Carbon::now()->format("Y-m-d"))->whereNull('completed_at')->orderBy('due_date', 'asc');
        }, filters: $filters);
        $newTasks = [];
        foreach($tasks as $i => $task) {
            $newTasks[] = [
                ...$task,
                'remaining_days' => (int) Carbon::parse(Carbon::now())->diffInDays($task['due_date'])
            ];
        }
        return $newTasks;
    }

    public function taskStatistics()
    {
        $tasks = $this->getTasks();
        return [
            'total' => $tasks->count(),
            'due' => $tasks->filter(function ($task, int $key) {
                return $task['task_status_id'] == 1;
            })->count(),
            'completed' => $tasks->filter(function ($task, int $key) {
                return $task['task_status_id'] == 2;
            })->count(),
            'due_today' => $this->dueToday()->count()
        ];
    }


}
