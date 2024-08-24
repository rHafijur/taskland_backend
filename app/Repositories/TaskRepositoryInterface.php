<?php

namespace App\Repositories;

interface TaskRepositoryInterface
{
    public function all($query, array $filters);


    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);

    public function complete($id);
}