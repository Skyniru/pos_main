<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends BaseController
{
    public function index()
    {
        // // Check if user is logged in
        // if (!session()->get('logged_in')) {
        //     return redirect()->to(base_url('login'));
        // }

        return view('templates/header')
        . view('templates/dashboard_nav')
        . view('dashboard_page')
        . view('templates/footer' );

    }
} 