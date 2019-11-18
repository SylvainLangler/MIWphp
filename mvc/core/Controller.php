<?php

class Controller{
    public $vars = [];

    public function set($vars){
        $this->vars = array_merge($this->vars, $vars);
    }

    public function render($view){

        extract($this->vars);


        $controller = strtolower(explode('Controller',get_class($this))[0]);
        
        $file = './view/'.$controller.'/'.$view.'.php';

        if(file_exists($file)){
            include $file;
        }
        else{
            die($file.' does not exist');
        }

    }
}