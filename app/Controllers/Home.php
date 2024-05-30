<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function login()
    {
        $data = [];

        if ($this->request->is('post')) {

            $rules = [
                'login' => 'required|min_length[6]|max_length[50]|valid_email',
                'senha' => 'required|min_length[8]|max_length[255]|validateUser[login,senha]',
            ];

            $errors = [
                'senha' => [
                    'validateUser' => "Email ou senha estão incorretos",
                ],
            ];

            if (!$this->validate($rules, $errors)) {

                return view('welcome_message', [
                    "validation" => $this->validator,
                ]);

            } else {
                $model = model(UserModel::class);

                $user = $model->where('login', $this->request->getVar('login'))->first();
                // Stroing session values
                $this->setUserSession($user);
                // Redirecting to dashboard after login
                if($user['role'] == "super_admin"){
                    return redirect()->to(base_url('admin'));

                }elseif($user['role'] == "user"){

                    return redirect()->to(base_url('user'));
                }
            }
        }
        return view($this->index());
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'nome' => $user['nome'],
            'email' => $user['email'],
            'login' => $user['login'],
            'status' => $user['status'],
            "role" => $user['role'],
            'isLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
