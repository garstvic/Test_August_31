<?php

class Users
{
    private $db;
    private $table_name='users';
    
    public function __construct()
    {
        $this->db=new Database;
    }
    
    public function getUsers()
    {
        $this->db->query("SELECT * FROM `".$this->table_name."`");

        return $this->db->findAll();
    }
    
    public function getUser($params)
    {
        if(empty($params)){
            return false;
        }

        $where="";

        $i=0;
        foreach(array_keys($params) as $column){
            if($i>0){
                $where.=" AND ";    
            }

            $where.="`{$column}` = :{$column}";
            $i=$i+1;
        }

        $this->db->query("SELECT * FROM `".$this->table_name."` WHERE {$where}");

        foreach($params as $column=>$value){
            $this->db->bind(":{$column}",$value);
        }

        return $this->db->findOne();
    }
    
    public function create($data)
    {
        $this->db->query("INSERT INTO `".$this->table_name."` (`name`,`email`,`password`,`confirm_token`) VALUES(:name,:email,:password,:confirm_token)");

        $this->db->bind(":name",$data['name']);
        $this->db->bind(":email",$data['email']);
        $this->db->bind(":password",$data['password']);
        $this->db->bind(":confirm_token",$data['confirm_token']);
        
        if(!$this->db->execute()){
            return false;
        }
        
        return true;
    }
    
    public function confirm($confirm_token)
    {
        if(strlen($confirm_token)){
            preg_match('/[a-z0-9]+/',$confirm_token,$matches);
            
            if(strlen($confirm_token)==strlen($matches[0])){
                $confirm_token=$matches[0];
                $user=$this->getUser(['confirm_token'=>$confirm_token]);

                if($user){
                    $this->db->query("UPDATE `".$this->table_name."` SET `confirmed` = 1, `confirm_token` = '' where id = :id");
                    $this->db->bind(":id",$user['id']);
                    
                    if($this->db->execute()){
                        return true;
                    }
                }
            }
        }

        return false;
    }
    
    public function isConfirmed($email)
    {
        $user=$this->getUser(['email'=>$email]);
        
        return $user ? $user['confirmed'] : false;

    }
    
    public function login($email,$password)
    {
        $user=$user=$this->getUser(['email'=>$email]);

        if($user){
            if(password_verify($password,$user['password'])){
                return true;
            }
        }
        
        return false;
    }
    
    public function update($id,$params=[])
    {

        if(!empty($params)){
            $user=$this->getUser(['id'=>$id]);

            if($user){
                $sql="UPDATE `".$this->user_model."` SET ";
                
                $set="";
        
                $i=0;
                foreach($params as $column=>$value){
                    if($i>0){
                        $set.=", ";    
                    }
        
                    $set.="`{$column}` = :{$column}";
                    $i=$i+1;
                }

                $this->db->query("UPDATE `".$this->table_name."`SET ".$set." WHERE `id` = :id");

                foreach($params as $column=>$value){

                    $this->db->bind(":{$column}",$value);
                }
                $this->db->bind(":id",$id);

                if($this->db->execute()){
                    return true;
                }
            }
        }
        
        return false;
    }
}