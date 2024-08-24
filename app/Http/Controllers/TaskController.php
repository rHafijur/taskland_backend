<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\CompleteTaskRequest;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $taskService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'data' => $this->taskService->allByAuthUser()
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->id();
        return [
            'data' => $this->taskService->create($data)
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        return [
            'data' => $this->taskService->update($request->except(['created_by','completed_at','task_status_id','due_date']), $id)
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return [
            'data' => $this->taskService->delete($id)
        ];
    }

    public function complete(CompleteTaskRequest $request)
    {
        return [
            'data' => $this->taskService->complete($request->id)
        ];
    }
}
