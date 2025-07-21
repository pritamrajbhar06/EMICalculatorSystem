<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function store($data)
    {
        return User::create($data);
    }

    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function update(int $userId, array $data)
    {
        User::where('id', $userId)->update($data);
    }

    
}
