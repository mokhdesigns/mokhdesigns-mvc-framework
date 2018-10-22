<?php 

// App Core Class
// Creates Url 
// Loads Core Controller
// Url Format - /Controller/Method/Params


class Core {
    
// Properties 
    
    protected $currentController = 'Pages';
    protected $currentMethod     = 'index';
    protected $params            = [];
    
    
// Methods
    
    // To Get The URL 
    public function getUrl() {
        
        // Check If The Url Is Set 
        if(isset($_GET['url'])){
            
            $url =  $_GET['url'];
            $url =  rtrim($url);
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        
   
    }
    
    // To Return The getUrl Method
    public function __construct() {
        
      $url = $this -> getUrl();
        
        
    // Look For The Controller In The First Param
        
    if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
        
       // If True Set It As The Current Controller 
        
      $this -> currentController = ucwords($url[0]);
        
      // Unset First Index ( $url[0] )
        
        unset($url[0]);
    }
        
    // Require The Controller 
        
        require_once '../app/controllers/' . $this -> currentController . '.php';
       
    // Init The Controller Class 
        
    $this -> currentController = new $this -> currentController;
        
    // Look For The Method In The Second Param    
    
        
    if(isset($url['1'])){
        
    // If True Check If The Method Exist In The Controller
        
    if(method_exists($this -> currentController, $url['1'])) {
        
        $this -> currentMethod = $url['1'];
        
       // Unset Second Index ( $url[1] )
        
        unset($url['1']);
    }
        
    }
        
    // Get The The Left Params And Store Them In An Array 
        
    $this -> params = $url ? array_values($url) : [];
        
    // Call a CallBack With Array Of Params
        
        call_user_func_array([$this -> currentController, $this -> currentMethod], $this -> params);
    } 
}