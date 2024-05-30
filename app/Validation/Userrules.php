<?php

namespace App\Validation;

use App\Models\UserModel;

class Userrules
{
    public function validateUser(string $str, string $fields, array $data): bool
    {
        $model = model(UserModel::class);
        $user = $model->where('login', $data['login'])->first();
        if (!$user) {
            return false;
        }
        return password_verify($data['senha'], $user['senha']);
    }
}
