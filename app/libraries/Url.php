<?php

class Url
{
    public static function redirect($page)
    {
        header('location: '.URLROOT.'/index.php?url='.$page);
    }
}