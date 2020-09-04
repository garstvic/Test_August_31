<?php

class Site extends Controller
{
    public function __construct()
    {
        $this->user_model=$this->model('User');
    }

    public function index()
    {
        $data=[
            'title'=>'Welcome Page',
        ];

        $this->view('site/index',$data);
    }
    
    public function login()
    {
        $data=[
            'title'=>'Login Page'
        ];

        $this->view('site/login',$data);
    }
}