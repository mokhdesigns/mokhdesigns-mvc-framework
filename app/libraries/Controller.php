<?php

// Loads The Models And The Views


class Controller {
    
    // Load The Model 
    
        public function model($model) {
        
     // Require The Model 
        
        require '../app/models/' . $model . '.php';
        
    // Init The Model 
        
        return new $model();
    }
    
    
    public function view($view, $data = []){
        
        $viewpass = '../app/views/' . $view . '.php';
        
    // Check If The View Exists
        
        if(file_exists($viewpass)) {
        
    // Require The View
            
        require $viewpass ;
                
        } else{
            
     // Stop The Page If The View Is Not Exists
            die('View Is Not Exist');
        }
    }
}