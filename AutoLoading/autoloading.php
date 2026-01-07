<?php
spl_autoload_register();

function myAutoLoader (string $className){
    $path = __DIR__."../".$className.".php";
    require $path ;
};