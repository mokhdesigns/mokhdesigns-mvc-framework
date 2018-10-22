<?php


// Require The Config File 

require_once 'config/config.php';


// Autoload The Core Libaries
// The Folder Name Should Be The Same As The The File Name

spl_autoload_register(function ($className) {
    
   require_once 'libraries/' . $className . '.php'; 
});