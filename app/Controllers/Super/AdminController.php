<?php

namespace App\Controllers\Super;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "super_admin") {
            echo 'Access denied';
            exit;
        }
    }
    public function index()
    {
        return view("admin/home-admin");
    }
}
