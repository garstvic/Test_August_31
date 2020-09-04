<?php

class User
{
    private $db;
    private $table_name='users';
    
    public function __construct()
    {
        $this->db=new Database;
    }
    
    public function getUsers()
    {
        $this->db->query("SELECT * FROM `$this->table_name`");

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
}