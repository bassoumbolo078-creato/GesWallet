<?php
namespace App\Core;
abstract class Controller{

    protected function __construct()
    {
        
    }
    protected function render(string $view,array $data=[]){
            $viewData=$data;
            require_once dirname(dirname(__DIR__))."/view/$view";
     }

     protected function redirectUrl(string $uri){
             $url=WEBROOT."/$uri";
              
              header("location: " . trim($url));
              exit;
     }
}