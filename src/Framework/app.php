<?php

namespace Framework;

use GuzzleHttp\Psr7\modifyRequest;

class App
{

    public function run(RequestInterface $request): ResponseInterface 
    {
        //Vérifier mon Url et si elle fini par un slash redirige les.
        //Je prend l'url
        $uri = $_SERVER['REQUEST_URI'];
        // Je récupére le dérnier caratére 
        //Si $uri n'est pas vide et le dernier caractére de $uri est un '/' 
        //alors il y a un probléme donc redirige sur la version sans le slash
        if (!empty($uri) && $uri[-1] === "/") {
            # code...
            header('Location:' . substr($uri, 0, -1));
            header('HTTP/1.1 301 Moved Permanently');
            exit();
        }
        echo 'salut';
    }
}