<?php
spl_autoload_register (function(string $className){
    $path = __DIR__."/".$className.".php";
    require $path ;
});