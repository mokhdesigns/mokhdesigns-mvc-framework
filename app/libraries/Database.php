<?php

// Connect TO The Database
// PDO Database Class


class Database {
    
    private $host   = DB_HOST;
    private $user   = DB_USER;
    private $pass   = DB_PASS;
    private $dbname = DB_NAME;
    
    private $dbh;
    private $stmt;
    private $error;
    
    public function __construct() {
        
        // Set The Connection 
        
        $dsn = 'mysql:host=' . $this -> host . ';dbname=' . $this->dbname;
        
        $options =array(
        
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE     => PDO::ERRMODE_EXCEPTION
            
        );
        
       try{
	        $this -> dbh = new PDO($dsn, $this -> user, $this -> pass, $options);
	     
          } catch(PDOExeeption $e){
           
	        $this -> error  =  $e->getMessage();
           
           echo  $this -> error;
          } 
        
    }
    
    
    // Method For Prepare Statment With Query 
    
    
    public function query($sql){
        
        $this -> stmt = $this -> dbh -> prepare($sql);
    }
    
 // Bind The Values 
    
    public function bind($param, $value, $type = null) {
        
        // Check The Type 
        
        if(is_null($type)) {
            
            switch (true){
                    
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                    
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                    
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                        
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        
        $this -> stmt->bindValue($param, $value, $type);
    }
    
   // Execute The Statment
    
    public function execute(){
        
        return $this -> stmt->execute();
    }
    
 // Fetch Results From The Database As Object
    
    
    public function resultSet() {
        
        $this -> execute();
        
        $this -> stmt -> fetchAll(PDO::FETCH_OBJ);
    }
  
    // Fetch Single Record As Object 
  public function single () {
      
        $this -> execute();
        $this -> stmt -> fetch(PDO::FETCH_OBJ); 
      
  }
    
    
    // Fetch Single Record As Object 
  public function rowCount () {
      
      return  $this -> stmt ->rowCount(); 
      
  }
    
    
    
}