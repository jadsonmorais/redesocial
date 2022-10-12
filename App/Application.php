<?php

namespace App;

error_reporting(E_ALL);
ini_set('display_errors', true);

class Application
{
    private $controller;
    private function setApp()
    {
        $loadNameABS = __DIR__ . '/Controllers/';
        $loadName = 'App\Controllers\\';
        $url = explode("/", $_GET['url']);

        #Se n tiver nada na minha URL
        if ($url[0] == '') {
            $loadName .= 'Home';
            $loadNameABS .= 'Home';
        } else {
            $loadName .= ucfirst(strtolower($url[0]));
            $loadNameABS .= ucfirst(strtolower($url[0]));
        }

        $loadName .= 'Controller';
        $loadNameABS .= 'Controller';

        # É preciso passar o caminho absolluto para a validação
        if (file_exists($loadNameABS . '.php')) {
            $this->controller = new $loadName();
        } else {
            include('Views/pages/404.php');
            die();
        }
    }

    public function run()
    {
        $this->setApp();
        $this->controller->index();
    }
}
