<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $model = model(UserModel::class);
        $model->insertBatch([
			[
				"nome" => "Rahul Sharma",
				"email" => "eleniciotea@outlook.com",
				"login" => "rahul_sharma@mail.com",
				"senha" => password_hash("12345678", PASSWORD_DEFAULT),
				"role" => "super_admin",
				"status" => "ativo",
			],
			[
				"nome" => "Prabhat Pandey",
				"email" => "eleniciosouza7@gmail.com",
				"login" => "prabhat@mail.com",
				"senha" => password_hash("12345678", PASSWORD_DEFAULT),
				"status" => "ativo",
				"role" => "user",
			]
		]);
    }
}
