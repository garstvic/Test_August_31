<?php

class Site
{
    public function __construct()
    {

    }
    
    public function index()
    {
        echo "Home Page";
    }
    
    public function about($id)
    {
        var_dump($id);
    }
}