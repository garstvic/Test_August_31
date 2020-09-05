<?php

class Site extends Controller
{
    public function index()
    {
        $data=[
            'title'=>'Welcome Page',
            'description'=>'SkySilk MVC Application'
        ];

        $this->view('site/index',$data);
    }
}