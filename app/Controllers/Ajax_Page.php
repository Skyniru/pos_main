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

}
