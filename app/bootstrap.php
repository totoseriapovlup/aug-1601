<?php

include_once '..' . DIRECTORY_SEPARATOR . 'config.php';

function url(string $controller = null,string $action = null){
    return \app\core\Route::url($controller, $action);
}

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $classFile = '..'.DIRECTORY_SEPARATOR.$class . '.php';
    if (file_exists($classFile)) {
        include_once $classFile;
        return true;
    }
    return false;
});
try{
    \app\core\Route::init();
}catch (Exception $e){
    //TODO log
    echo 'Oops thomething went wrong';
}
