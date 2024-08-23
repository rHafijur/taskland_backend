<?php

namespace App\Services;

use App\Repositories\ProjectRepositoryInterface;

class ProjectService
{
    public function __construct(
        protected ProjectRepositoryInterface $projectRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->projectRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->projectRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->projectRepository->delete($id);
    }

    public function all()
    {
        return $this->projectRepository->all();
    }

    public function find($id)
    {
        return $this->projectRepository->find($id);
    }
}
