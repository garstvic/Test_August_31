<?php

class Site extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $data=[
            'title'=>'Welcome Page'
        ];

        $this->view('site/index',$data);
    }
}