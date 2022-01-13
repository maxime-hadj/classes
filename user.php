<?php
session_start();

class user{
    public $db;
    private $id;
    public $login;
    protected $password;
    public $email;
    public $firstname;
    public $lastname;

    public function __construct(){
    $this->db = mysqli_connect ('localhost' , 'root' , '' , 'classes');
    echo 'connected_db';
}

public function register($login, $email, $firstname, $lastname, $password){
    $this->login = $login;
    $this->email = $email;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->password = $password;
    $request = mysqli_query($this->db, "INSERT INTO utilisateurs (login, email, firstname, lastname, password) VALUES ('$this->login', '$this->email', '$this->firstname', '$this->lastname', '$this->password')");
    $requestalt = mysqli_query($this->db, "SELECT * FROM utilisateurs WHERE login = '$this->login'");
    $result = $requestalt->fetch_array(MYSQLI_ASSOC);
    //var_dump($result);
    echo 'registered';
}

public function connect($login, $password){
    $this->login = $login;
    $this->password = $password;
    $requestalt = mysqli_query($this->db, "SELECT * FROM utilisateurs WHERE login = '$this->login'");
    $resultalt = $requestalt->fetch_array(MYSQLI_ASSOC);
    $_SESSION['user'] = $resultalt;
    echo 'connected';
}

public function disconnect(){
    session_destroy();
    echo 'disconnected';
}

public function delete($login, $email, $firstname, $lastname, $password){
    $this->login = $login;
    $this->email = $email;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->password = $password;
    $request = mysqli_query($this->db,"DELETE FROM utilisateurs WHERE login ='$this->login'");
    session_destroy();
    var_dump($request);
    echo 'deleted';
}
public function update($login, $email, $firstname, $lastname, $password){
    $this->login = $login;
    $this->email = $email;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->password = $password;
    $requestalt = mysqli_query($this->db, "UPDATE utilisateurs SET login = 'john', email = '$this->email', firstname = '$this->firstname', lastname = '$this->lastname', password = '$this->password' WHERE login = '$this->login'");
    var_dump($requestalt);
    echo 'updated';
}

public function isConnected(){
    $this->login = $_SESSION['user'];
        if(isset($_SESSION['user'])){
        echo 'connected_r';
}       
        else{
        echo 'not connected_r';
}
        //var_dump($_SESSION['user']);
}

public function getAllInfos(){
    $id = $_SESSION['user']['id'];
    $request = mysqli_query($this->db, "SELECT * FROM utilisateurs WHERE id = '$id'");
    $result = mysqli_fetch_array($request);
    echo $result['id'] .'<br/>';
    echo $result['login'] .'<br/>';
    echo $result['email'] .'<br/';
    echo $result['firstname'] .'<br/';
    echo $result['lastname'] .'<br/>';
    echo $result['password'] .'<br/>';
}

public function getLogin(){
    $id = $_SESSION['user']['id'];
    $request = mysqli_query($this->db, "SELECT login FROM utilisateurs WHERE id = '$id'");
    $result = mysqli_fetch_array($request);
    echo $result['id'] . '<br/>';
}

public function getEmail(){
    $id = $_SESSION['user']['id'];
    $request = mysqli_query($this->db, "SELECT email FROM utilisateurs WHERE id = '$id'");
    $result = mysqli_fetch_array($request);
    echo $result['email'] . '<br/>';
}

public function getFirstname(){
    $id = $_SESSION['user']['id'];
    $request = mysqli_query($this->db, "SELECT firstname FROM utilisateurs WHERE id = '$id'");
    $result = mysqli_fetch_array($request);
    echo $result['firstname'] . '<br/>';
}

public function getLastname(){
    $id = $_SESSION['user']['id'];
    $request = mysqli_query($this->db, "SELECT lastname FROM utilisateurs WHERE id = '$id'");
    $result = mysqli_fetch_array($request);
    echo $result['lastname'] . '<br/>';
}
}


$user = new User();
//$user->register('moi', 'moi@moi.com', 'moi1', 'moi2', 'azerty2');
//$user->connect('john', 'max@max.com', 'max1', 'max2', 'azerty');
//$user->disconnect('max', 'max@max.com', 'max1', 'max2', 'azerty');
//$user->delete('moi', 'moi@moi.com', 'moi1', 'moi2', 'azerty2');
//$user->update('max', 'max@max.com', 'max1', 'max2', 'azerty');
//$user->isConnected('john', 'max@max.com', 'max1', 'max2', 'azerty');
//$user->getAllInfos('john', 'max@max.com', 'max1', 'max2', 'azerty');
//$user->getLogin('john', 'max@max.com', 'max1', 'max2', 'azerty');
//$user->getEmail('john', 'max@max.com', 'max1', 'max2', 'azerty');   
//$user->getFirstname('john', 'max@max.com', 'max1', 'max2', 'azerty');
//$user->getLastname('john', 'max@max.com', 'max1', 'max2', 'azerty');
?>