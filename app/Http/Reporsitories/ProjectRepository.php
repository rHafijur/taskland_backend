<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function all()
    {
        return Project::all();
    }

    public function create(array $data)
    {
        return Project::create($data);
    }

    public function update(array $data, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($data);
        return $project;
    }

    public function delete($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
    }

    public function find($id)
    {
        return Project::findOrFail($id);
    }
}
