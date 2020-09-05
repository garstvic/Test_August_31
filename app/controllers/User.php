<?php

class User extends Controller
{
    public function __contstruct()
    {
        
    }
    
    public function signup()
    {
        if(stripos($_SERVER['REQUEST_METHOD'],'POST')===0){
            
        }else{
            $data=[
                'name'=>'',
                'email'=>'',
                'password'=>'',
                'confirm_password'=>'',
                'name_err'=>'',
                'email_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>'',
            ];
            
            $this->view('user/signup',$data);
        }
    }
    
    public function login()
    {
        if(stripos($_SERVER['REQUEST_METHOD'],'POST')===0){
            
        }else{
            $data=[
                'email'=>'',
                'password'=>'',
                'email_err'=>'',
                'password_err'=>'',
            ];
            
            $this->view('user/login',$data);
        }
    }    
}