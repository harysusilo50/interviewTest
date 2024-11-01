<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct()
    {
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        $data['title'] = 'Home';
        return view('home/index', $data);
    }
}
