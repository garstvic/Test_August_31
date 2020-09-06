<?php

class Site extends Controller
{
    public function index()
    {
        $data=[
            'title'=>'Welcome '.$_SESSION['user']['name'] ?? 'Page',
            'description'=>$_SESSION['user']['email'] ?? 'SkySilk MVC Application',
        ];

        $this->view('site/index',$data);
    }
}