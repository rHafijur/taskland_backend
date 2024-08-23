<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    private function mapper($user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role->name,
            'role_id' => $user->role->id,
        ];
    }

    public function all()
    {
        return User::with('role')->get()->map(function ($user) {
            return $this->mapper($user);
        });
    }

    public function create(array $data)
    {
        return $this->mapper(User::create($data));
    }

    public function update(array $data, $id)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $this->mapper($user);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }
}