<?php

#Autoload PHP8

spl_autoload_register(function($className)
{
    $fileName = "class" . DIRECTORY_SEPARATOR . $className.".php";
    # Directory = LINUX / MAC / WINDOWS
    //$fileName = str_replace("class"."\\", "/", . DIRECTORY_SEPARATOR . $className.".php");
    
    if(file_exists(($fileName)))
    {require_once($fileName);}
});

?>