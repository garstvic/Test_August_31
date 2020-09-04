<?php

class Database
{
    private $path=DBPATH;
    private $name=DBNAME;
    
    private $dbh;
    private $stmt;
    private $error;
    
    public function __construct()
    {
        $filename=APPROOT.'/'.$this->path.'/'.$this->name;

        try{
            $this->dbh=new SQLite3($filename);
        }catch(Exception $e){
            $this->error=$e->getMessage();
            echo $this->error;
        }
    }

    public function query($sql)
    {
        $this->stmt=$this->dbh->prepare($sql);
    }

    public function bind($param,$value,$type=null)
    {
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type=SQLITE3_INTEGER;
                    break;
                case is_float($value):
                    $type=SQLITE3_FLOAT;
                    break;
                case is_bool($value):
                    $type=SQLITE3_BLOB;
                    break;
                case is_null($value):
                    $type=SQLITE3_NULL;
                    break;
                default:
                    $type=SQLITE3_TEXT;
            }
        }

        $this->stmt->bindParam($param,$value,$type);
    }
    
    public function execute()
    {
        return $this->stmt->execute();
    }
    
    public function findAll()
    {
        $result=[];
        $execute=$this->execute();

        while($row=$execute->fetchArray(SQLITE3_ASSOC)){
            $result[]=$row;

        }

        return $result;
    }

    public function findOne()
    {
        return $this->execute()->fetchArray(SQLITE3_ASSOC);
    }

    public function rowCount()
    {
        return $this->stmt->numColumn();
    }
}