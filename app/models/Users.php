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

        $i=1;
        foreach($params as $column=>$value){
            if($i>1){
                $where.=" AND ";    
            }

            $where.="{$column} = '{$value}'";
            $i=$i+1;
        }

        $this->db->query("SELECT * FROM `{$this->table_name}` where {$where}");

        foreach($params as $column=>$value){
            $this->db->bind(":{$column}",$value);
        }

        return $this->db->findOne();
    }
    
    public function create($data)
    {
        $this->db->query("INSERT INTO ".$this->table_name." (`name`,`email`,`password`,`confirm_token`) VALUES(:name,:email,:password,:confirm_token)");

        $confirm_token=md5(uniqid().$data['name'].$data['email'].$data['password']);

        $this->db->bind(":name",$data['name']);
        $this->db->bind(":email",$data['email']);
        $this->db->bind(":password",$data['password']);
        $this->db->bind(":confirm_token",$confirm_token);
        
        if(!$this->db->execute()){
            return false;
        }
        
        return true;
    }
}