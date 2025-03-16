<?php
class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname ="attendance_db";
    public $conn=null;
    
    public public function __construct(){
        try{
            $this->conn =new PDO("mysql:host=$this->servername;dbname=$this->dbname",$this->username,$this->password);
            //set the PDO error mode to exception 
           $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        }catch(PDOException $e){
            echo "Connected failed: ". $e->getMessage();
    }  
} 
}
?>
<?php
try{
    $cmd="create table tab2 (id int auto_increment primary key, 
    col2 varchar(23))";
    $st=$conn->prepare($cmd);
    $st->execute();
}
catch(PDOException $e){
    echo "<br>tab2 not created" . $e->getMessage();
}

try{
    $cmd="create table tab3 (id int auto_increment primary key, 
    col2 varchar(23))";
    $st=$conn->prepare($cmd);
    $st->execute();
}
catch(PDOException $e){
    echo "<br>tab3 not created" . $e->getMessage();
}

try{
    $cmd="create table tab4 (id int auto_increment primary key, 
    col2 varchar(23))";
    $st=$conn->prepare($cmd);
    $st->execute();
}
catch(PDOException $e){
    echo "<br>tab4 not created" . $e->getMessage();
}
?>
