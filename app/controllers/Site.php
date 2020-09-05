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
            'description'=>'SkySilk MVC Application'
        ];

        $this->view('site/index',$data);
    }
    
    public function login()
    {
        $data=[
            'title'=>'Login Page',
            'description'=>'SkySilk MVC Application'
        ];

        $this->view('site/login',$data);
    }
    
    public function signup()
    {
        $data=[
            'title'=>'Sign Up Page',
            'description'=>'SkySilk MVC Application'
        ];

        $this->view('site/signup',$data);
    }    
}