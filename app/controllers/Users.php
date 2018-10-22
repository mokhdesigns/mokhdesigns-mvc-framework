<?php 


class Users extends Controller{
    
    
    public function __construct () {
        
    }
    
    public function register () {
        
        // Register Form
        // Check The Request Method
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // If It True Collect The Data
         
            // Filter The Data Coming From The Form 
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Collect The Data
                        
           $data = [ 
                    'name'             => trim($_POST['name']),
                    'email'            => trim($_POST['email']),
                    'password'         => trim($_POST['pass']),
                    'c_password'       => trim($_POST['cpass']),
                    'name_error'       => '',
                    'email_error'      => '',
                    'password_error'   => '',
                    'c_password_error' => '',
                   ]; 
            
            // Validate The Name
            
            if(empty($data['name'])){
                
                $data['name_error'] = "Please Enter Your Name";
            }
            
            // Validate The Email
            
            if(empty($data['email'])){
                
                $data['email_error'] = "Please Enter A Valide Email";
            } 
               
            // Validate The Password
            
            if(empty($data['password'])){
                
                $data['password_error'] = "Please Enter Your Password";
                
              // Validate The Password Length  
                
            }elseif(strlen($data['password']) < 6){
                 $data['password_error'] = "Please Choose Strong Password";
            }
               
            // Validate The Name
            
            if(empty($data['c_password'])){
                
                $data['c_password_error'] = "Please Enter A Confirmation Password";
                
            } elseif($data['password'] != $data['c_password']){
                
                 $data['c_password_error'] = "Password Doesnt Match";
            }
               
            // If There's No Error Continue 
            
            if(empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['c_password_error'])){
                
                echo 'Good To Go';
                
            }else{
                $this -> view('Users/register', $data);
            }
            
            
        }else{
            
            // If It Flase Desplay The Errors 
            
           $data = [ 
                    'name'             => '',
                    'email'            => '',
                    'password'         => '',
                    'c_password'       => '',
                    'name_error'       => '',
                    'email_error'      => '',
                    'password_error'   => '',
                    'c_password_error' => '',
                   ];    
                    // Load The Register View
        
        $this -> view('users/register', $data);
        }
        

    }
    
    // Login Form
    
     public function login () {
        
        // Check The Request Method
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
// Check If The Request Is Coming form The Login Form
            if(isset($_POST['login'])){
            // If It True Collect The Data
         
            // Filter The Data Coming From The Form 
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Collect The Data
                        
           $data = [ 
                    'email'            => trim($_POST['email']),
                    'password'         => trim($_POST['pass']),
                    'email_error'      => '',
                    'password_error'   => ''
                   ]; 
            

            // Validate The Email
            
            if(empty($data['email'])){
                
                $data['email_error'] = "Please Enter A Valide Email";
            } 
               
            // Validate The Password
            
            if(empty($data['password'])){
                
                $data['password_error'] = "Please Enter Your Password";
                  
            }
               
               
            // If There's No Error Continue 
            
            if(empty($data['email_error']) && empty($data['password_error'])){
                
          // Hash The Password
                
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            
          // Register The User
                
        if($this -> userModel -> register($data)){
            
            echo 'good to go';
            
        }else{
            die("Unknown Error");
        }
            }else{
                $this -> view('Users/login', $data);
            }
            
            
        }else{
            
            // If It Flase Desplay The Errors 
            
           $data = [ 
                    'email'            => '',
                    'password'         => '',
                    'email_error'      => '',
                    'password_error'   => '',
                   ];    
                    // Load The Register View
        
        $this -> view('users/login', $data);
        }
        
        }
    }
    
       
}