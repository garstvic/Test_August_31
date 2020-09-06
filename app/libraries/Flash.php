<?php

class Flash
{
    public static function message($name='',$message='',$class='alert alert-success')
    {
        if(!empty($name)){
            if(!empty($message) and empty($_SESSION[$name])){
                if(!empty($_SESSION[$name])){
                    unset($_SESSION[$name]);
                }

                if(!empty($_SESSION["{$name}_class"])){
                    unset($_SESSION["{$name}_class"]);
                }

                $_SESSION[$name]=$message;
                $_SESSION["{$name}_class"]=$class;
            }elseif(empty($message) and !empty($_SESSION[$name])){
                $class=!empty($_SESSION["{$name}_class"]) ? $_SESSION["{$name}_class"] : '';
                
                echo "<div class=\"{$class}\" id=\"msg-flash\">".$_SESSION[$name]."</div>";
                
                unset($_SESSION[$name]);
                unset($_SEDDION["{$name}_class"]);
            }
        }
    }
}