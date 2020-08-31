<?php

class Core
{
    protected $controller='Site';
    protected $action='index';
    protected $params=[];
    
    public function __construct()
    {
        $url=$this->getUrl();
        
        if(isset($url[0])){
            $controller=ucwords($url[0]);
        
            if(file_exists("../app/controllers/{$controller}.php")){
                $this->controller=$controller;
            }

            unset($url[0]);

            if(isset($url[1])){
                $action=strtolower($url[1]);
                
                if(method_exists($this->controller,$action)){
                    $this->action=$action;
                }
                
                unset($url[1]);
            }
            
            $this->params=$url ? array_values($url) : [];
        }

        require_once '../app/controllers/'.$this->controller.'.php';

        $this->controller=new $this->controller;

        call_user_func_array([$this->controller,$this->action],$this->params);
    }
    
    private function getUrl()
    {
        if(isset($_GET['url'])){
            $url=rtrim($_GET['url'],'/');
            $url=filter_var($url,FILTER_SANITIZE_URL);
            $url=explode('/',$url);
            
            return $url;
        }
    }
}