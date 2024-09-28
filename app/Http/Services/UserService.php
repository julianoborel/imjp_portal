<?php

namespace App\Http\Services;

use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Services\BaseService;
use App\Models\User;

class UserService extends BaseService
{
    protected $model = User::class;

    public function index()
    {
        $users = User::all();

        return UserResource::collection($users);
    }

    public function store(UserRequest $request)
    {
        $user = User::create($request->all());

        return new UserResource($user);
    }

    public function show(int $userId)
    {
        $user = User::findOrFail($userId);
        return new UserResource($user);
    }

    public function update(UserRequest $request, int $userId)
    {
        $user = User::findOrFail($userId);
        $user->update($request->all());

        return new UserResource($user);
    }

    public function destroy(int $userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return true;
    }
}