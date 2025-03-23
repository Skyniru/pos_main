<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Auth extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $this->userModel->getUserbyUsername($username);

            if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
                $session = session();
                $userData = [
                    'user_id' => $user['user_id'],
                    'username' => $user['username'],
                    'fname' => $user['fname'],
                    'role' => $user['role'],
                    'logged_in' => true
                ];
                $session->set($userData);
                return redirect()->to(base_url('dashboard'));
            } else {
                return redirect()->to(base_url('register'))
                    ->with('error', 'User not found. Please register first.');
            }
        }

        return view('login_page');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'fname' => 'required|min_length[2]',
                'lname' => 'required|min_length[2]',
                'username' => 'required|min_length[4]|is_unique[users.username]',
                'password' => 'required|min_length[6]',
                'confirm_password' => 'required|matches[password]'
            ];

            if ($this->validate($rules)) {
                $data = [
                    'fname' => $this->request->getPost('fname'),
                    'mname' => $this->request->getPost('mname'),
                    'lname' => $this->request->getPost('lname'),
                    'username' => $this->request->getPost('username'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'role' => 'user' // Default role for new registrations
                ];

                $this->userModel->insert($data);
                return redirect()->to(base_url('login'))
                    ->with('success', 'Registration successful! Please login.');
            } else {
                return view('register_page', [
                    'validation' => $this->validator
                ]);
            }
        }

        return view('register_page');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
} 