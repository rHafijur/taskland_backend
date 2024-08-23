<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository implements ProjectRepositoryInterface
{
    private function mapper($project)
    {
        return [
            'id' => $project->id,
            'title' => $project->title,
            'creator_name' => $project->createdBy->name
        ];
    }

    public function all()
    {
        return Project::all()->map(function ($project) {
            return $this->mapper($project);
        });
    }

    public function create(array $data)
    {
        return $this->mapper(Project::create($data));
    }

    public function update(array $data, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($data);
        return $this->mapper($project);
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
