<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {
    }

    public function index()
    {
        return [
            'tasks' => $this->dashboardService->allTasks(),
            'upcomingDeadlineTasks' => $this->dashboardService->upcomingDeadlineTasks(),
            'taskStatistics' => $this->dashboardService->taskStatistics(),
        ];
    }
}