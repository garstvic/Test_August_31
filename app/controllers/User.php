<?php

class User extends Controller
{
    public function __construct()
    {
        $this->user_model=$this->model('Users');
    }

    public function signup()
    {
        if(stripos($_SERVER['REQUEST_METHOD'],'POST')===0){
            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            $data=[
                'name'=>trim($_POST['name']),
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'confirm_password'=>trim($_POST['confirm_password']),
                'name_err'=>'',
                'email_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>'',
            ];

            if(empty($data['name'])){
                $data['name_err']='Please enter name';
            }

            if(empty($data['email'])){
                $data['email_err']='Please enter email';
            }elseif(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
                $data['email_err']='Please enter valid email';
            }elseif($this->user_model->getUser(['email'=>$data['email']])){
                 $data['email_err']='Email is already taken';
            }

            if(empty($data['password'])){
                $data['password_err']='Please enter password';
            }else{
                if(strlen($data['password'])<8){
                    $data['password_err']='Password must include at least eight characters';
                }elseif(!preg_match("/[0-9]+/",$data['password'])){
                    $data['password_err']='Password must include at least one number';
                }elseif(!preg_match("/[a-z]+/",$data['password'])){
                    $data['password_err']= 'Password must include at least one letter';
                }elseif(!preg_match("/[A-Z]+/",$data['password'])){
                    $data['password_err']='Password must include at least one CAPS';
                }elseif( !preg_match("/\W+/",$data['password'])){
                    $data['password_err']='Password must include at least one symbol';
                }
            }

            if(empty($data['confirm_password'])){
                $data['confirm_password_err']='Please enter confirm password';
            }else{
                if($data['password']!==$data['confirm_password']){
                    $data['confirm_password_err']='Passwords do not match';
                }
            }

            if(empty($data['name_err']) and empty($data['email_err']) and empty($data['password_err']) and empty($data['confirm_password_err'])){
                $data['password']=password_hash($data['password'],PASSWORD_DEFAULT);
                $data['confirm_token']=md5(uniqid().$data['name'].$data['email'].$data['password']);
                
                if($this->user_model->create($data)){
                    Mail::sendConfirmMessage($data['email'],$data['confirm_token'],$data['name'],);
                    Flash::message('register_success','You are registered, please confirm your email');
                    Url::redirect('user/login');
                }
            }else{
                $this->view('user/signup',$data);
            }
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
            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            $data=[
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'email_err'=>'',
                'password_err'=>'',
            ];

            if(empty($data['email'])){
                $data['email_err']='Please enter email';
            }

            if(empty($data['password'])){
                $data['password_err']='Please enter password';
            }
            
            if($this->user_model->getUser(['email'=>$data['email']])){
                
            }else{
                $data['email_err']='No user found';
            }            

            if(empty($data['email_err']) and empty($data['password_err'])){
                $is_confirmed=$this->user_model->isConfirmed($data['email']);

                if($is_confirmed){
                    $is_logged=$this->user_model->login($data['email'],$data['password']);
    
                    if($is_logged){
                        exit("SUCCESS");
                    }else{
                        $data['password_err']='Password incorrect';

                        $this->view('user/login',$data);
                    }
                }else{
                    Flash::message('confirm_success','Your account is not confirmed','alert alert-danger');
                    $this->view('user/login',$data);
                }
            }else{
                $this->view('user/login',$data);
            }
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

    public function confirm($token)
    {
        if($token){
           if($this->user_model->confirm($token)){
                Flash::message('confirm_success','Your account is confirmed');
                Url::redirect('user/login');
            }
        }else{
            Url::redirect('site/index');
        }
    }
}