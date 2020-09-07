<?php

class Site extends Controller
{
    public function index()
    {
        if(!isset($data)){
            if(isset($_SESSION['user'])){
                $data=[
                    'title'=>'Welcome, '.$_SESSION['user']['name'],
                    'description'=>$_SESSION['user']['email'],
                    'name'=>$_SESSION['user']['name'],
                    'password'=>''
                ];
            }else{
                $data=[
                    'title'=>'Welcome Page',
                    'description'=>'SkySilk MVC Application',
                ];
            }
        }

        $this->view('site/index',$data);
    }
}