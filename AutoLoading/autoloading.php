<?php
spl_autoload_register (function(string $className){
    $path = __DIR__."../../".str_replace("\\","/",$className).".php";
    require $path ;
});