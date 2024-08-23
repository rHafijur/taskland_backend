<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\ProjectService;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectService $projectService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            "data" => $this->projectService->all()
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
    public function store(StoreProjectRequest $request)
    {
        $data = $request->only(['title']);
        $data['created_by'] = auth()->id();
        return [
            "data" => $this->projectService->create($data)
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        return [
            "data" => $this->projectService->update($request->only(['title']), $id)
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return [
            "data" => $this->projectService->delete($id)
        ];
    }
}
