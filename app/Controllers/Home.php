<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $new_system = $userModel->getAllofUsers();
        // if($new_system){

        //     return view('templates/header')
        //         . view('templates/navbar')
        //         . view('login_page')
        //         . view('templates/footer');
        // }else{
        //     session()->setFlashdata('system_startup', 'Register your admin credentials before proceeding.');
        //     return redirect()->to('register');
        // }

        return view('templates/header')
                . view('templates/navbar')
                . view('login_page')
                . view('templates/footer');
    }

    public function register()
    {
        $data = [
            'page_title' => 'sampledata',
        ];
        return view('templates/header', $data)
        . view('templates/navbar', $data)
        . view('register_page', $data)
        . view('templates/footer' , $data);

    }

    public function verifyRegister()
    {
        $usermodel = new UserModel();
        $message = "Input Empty";
        $data = [];
        if(isset($_POST) && !empty($_POST)){

            $post_data = [
                'username'          => $_POST['username'],
                'password'          => $_POST['password'],
                'confirm_password'  => $_POST['confirm_password'],
                'fname'             => $_POST['fname'],
                'mname'             => $_POST['mname'],
                'lname'             => $_POST['lname'],
            ];

            $rule = [
                'username'          => [
                    'rules'  => 'required|min_length[4]|is_unique[users.username]',
                    'errors' => [
                        'required' => 'You must choose a Username.',
                        'min_length' => 'Username must at least have 4 characters',
                        'min_length' => 'Your username already exist. Please enter a new one.',
                    ],
                ],
                'password'          => [    
                    'rules'  => 'required|min_length[10]',
                    'errors' => [
                        'required' => 'You must choose a Password.',
                        'min_length' => 'Password must at least have 10 characters',
                    ],
                ],
                'confirm_password'  => [
                    'rules'  => 'required|min_length[10]|matches[password]',
                    'errors' => [
                        'required' => 'You must enter Confirm Password.',
                        'min_length' => 'Confirm Password must at least have 10 characters',
                        'matches' => 'Confirm Password should match the Password.',
                    ],
                ],
                'fname'             => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'You must enter First Name.',
                    ],
                ],
                'lname'             => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'You must enter Last Name.',
                    ],
                ],
            ];

            if ($this->validateData($post_data, $rule)) {
  
                session()->set($post_data);
                $data['response_data'] = $usermodel->registerNewUser($post_data);
                $data['response_status']= 'Success';
                session()->setFlashdata('response', $data);
                return redirect()->to('register');
            }else{
                $data['response_data'] = $this->validator->getErrors();
                $data['response_status'] = 'Error';
                session()->setFlashdata('response', $data);
                return redirect()->to('register');
            }
        }

        
    }


    public function dashboard()
    {
        return view('dashboard_page');
    }

    public function sample()
    {
        return view('templates/header')
        . view('templates/navbar')
        . view('register_page')
        . view('templates/footer' );
    }

    public function login()
    {
        $userModel = new UserModel();

        if(isset($_POST['username'])){

            $rule = [
                'username'  => 'required|max_length[30]',
                'password'  => 'required|max_length[255]|min_length[10]',
            ];

            $post_data = [
                'username'  => $_POST['username'],
                'password'  => $_POST['password'],
            ];
    
            if ($this->validateData($post_data, $rule)) {
                $user_data = $userModel->getUserbyUsername($post_data['username']);
                if($user_data){
                    $confirm_password = $userModel->verifyPassword($post_data['password'], $user_data['password']);
                    if($confirm_password){
                        session()->set($user_data);
                        return redirect()->to('dashboard');
                    }
                }
            }
        }
    }
    
    public function inventory()
    {
        $data = [
            'inventory' => 'inventory_page',
        ];

        return view('templates/header', $data)
                . view('templates/navbar')
                . view('inventory_page', $data)
                . view('templates/footer');
    }

    //Template
    public function sampledata()
    {
        $data = [
            'page_title' => 'sampledata',
        ];

        return view('templates/header', $data)
                . view('templates/navbar')
                . view('login_page', $data)
                . view('templates/footer');
    }
}
