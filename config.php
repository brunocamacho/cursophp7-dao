<?php

    spl_autoload_register(function($nomeClasse){
        
        $dir = "class";
        $filename = $dir . DIRECTORY_SEPARATOR . $nomeClasse . ".php";
        if(file_exists($filename)){
            require_once $filename;
        }
    });

?>