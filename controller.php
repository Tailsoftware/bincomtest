<?php
session_start();

class Database{
    private $server='localhost';
    private $user='root';
    private $pass='';
    private $dbname='bincom_test';
    protected $conn;

    public function __construct()
    {
        try{
          $this->conn=mysqli_connect($this->server,$this->user,$this->pass,$this->dbname);
          if($this->conn){

          }
          else{
            echo'Database not connected';
          }
        }
        catch(mysqli_sql_exception $e){
            echo'Database Error'.$e->getMessage();

        }
    }

}


class Functions  extends Database  {
    public $conn;
    public $database;
    public $query;
    public $send;
    public $result;
    public $resultnum;
    public $query2;
    public $send2;
    public $result2;
    public $resultnum2;
    public $query3;
    public $send3;
    public $result3;
    public $resultnum3;
    public $sumscore;
    public $score;

    public function __construct()
    {
        parent::__construct();

        $this->database = new Database();
        $this->conn = $this->database->conn;

        $_SESSION['tscore'] = '0';

    }


    public function insertunitscore($party,$unit,$score)
    {
        $this->query="INSERT INTO newunit (party,unit,score) VALUES('$party','$unit','$score')";
        $this->send = $this->conn->query($this->query);
        
        
    }
}


$functions = new Functions();