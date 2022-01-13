<?php
session_start();

//$db_host = "localhost";
//$db_user = "root";
//$db_password = "";
//$db_name = "classes";

/*try{
    $db = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo 'connected_db';
}
catch(PDOEXCEPTION $e){
    echo $e->getMessage();
}*/

class User{
    public $db;
    private $id;
    public $login;
    protected $password;
    public $email;
    public $firstname;
    public $lastname;

public function __construct($db_user='root', $db_name='classes', $db_password='', $db_host='localhost'){
    $this->db = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
    //echo 'ok';
}

public function register($login, $email, $firstname, $lastname, $password){
    $this->login = $login;
    $this->email = $email;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->password = $password;
    $select_stmt = $this->db->prepare("INSERT INTO utilisateurs (login, email, password, firstname, lastname) VALUES ('$this->login', '$this->email', '$this->password', '$this->firstname', '$this->lastname')");
    $select_stmt->execute();
    $select_stmt2 = $this->db->prepare("SELECT * FROM utilisateurs WHERE login = '$this->login'");
    $select_stmt2->execute();
    $row = $select_stmt2->fetch(PDO::FETCH_ASSOC);
    echo 'registered';
    //var_dump($row);
}

public function connect($login, $password){
    $this->login = $login;
    $this->password = $password;
    $select_stmt2 = $this->db->prepare("SELECT * FROM utilisateurs WHERE login = '$this->login'");
    $select_stmt2->execute();
    $row = $select_stmt2->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user'] = $row;
    var_dump($row);
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
    $select_stmt2 = $this->db->prepare("DELETE FROM utilisateurs WHERE login = '$this->login'");
    $select_stmt2->execute();
    session_destroy();
    var_dump($select_stmt2);
}

public function update($login, $email, $firstname, $lastname, $password){
    $this->login = $login;
    $this->email = $email;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->password = $password;
    $select_stmt2 = $this->db->prepare("UPDATE utilisateurs SET login = 'john', email = '$this->email', firstname = '$this->firstname', lastname = '$this->lastname', password = '$this->password' WHERE login = '$this->login'");
    $select_stmt2->execute();
    var_dump($select_stmt2);
}

public function isConnected(){
    $this->login = $_SESSION['user'];
        if(isset($_SESSION['user'])){
        echo 'connected_r';
}       
        else{
        echo 'not connected_r';
}
        var_dump($_SESSION['user']);
}

public function getAllInfos(){
    $id = $_SESSION['user']['id'];
    $select_stmt2 = $this->db->prepare("SELECT * FROM utilisateurs WHERE id = '$id'");
    $select_stmt2->execute();
    $row = $select_stmt2->fetch(PDO::FETCH_ASSOC);
    echo $row['id'] .'<br/>';
    echo $row['login'] .'<br/>';
    echo $row['email'] .'<br/';
    echo $row['firstname'] .'<br/';
    echo $row['lastname'] .'<br/>';
    echo $row['password'] .'<br/>';
}

public function getLogin(){
    $id = $_SESSION['user']['id'];
    $select_stmt2 = $this->db->prepare("SELECT login FROM utilisateurs WHERE id = '$id'");
    $select_stmt2->execute();
    $row = $select_stmt2->fetch(PDO::FETCH_ASSOC);
    echo $row['login'] .'<br>';
}

public function getEmail(){
    $id = $_SESSION['user']['id'];
    $select_stmt2 = $this->db->prepare("SELECT email FROM utilisateurs WHERE id = '$id'");
    $select_stmt2->execute();
    $row = $select_stmt2->fetch(PDO::FETCH_ASSOC);
    echo $row['email'] .'<br>';
}

public function getFirstName(){
    $id = $_SESSION['user']['id'];
    $select_stmt2 = $this->db->prepare("SELECT firstname FROM utilisateurs WHERE id = '$id'");
    $select_stmt2->execute();
    $row = $select_stmt2->fetch(PDO::FETCH_ASSOC);
    echo $row['firstname'] .'<br>';
}

public function getLastname(){
    $id = $_SESSION['user']['id'];
    $select_stmt2 = $this->db->prepare("SELECT lastname FROM utilisateurs WHERE id = '$id'");
    $select_stmt2->execute();
    $row = $select_stmt2->fetch(PDO::FETCH_ASSOC);
    echo $row['lastname'] .'<br>';
}
}

$user = new User();
//$user->register('moi', 'moi@moi.com', 'moi1', 'moi2', 'azerty2');
//$user->connect('john', 'moi@moi.com', 'moi1', 'moi2', 'azerty2');
//$user->disconnect('moi', 'moi@moi.com', 'moi1', 'moi2', 'azerty2');
//$user->delete('moi', 'moi@moi.com', 'moi1', 'moi2', 'azerty2');
//$user->update('moi', 'moi@moi.com', 'moi1', 'moi2', 'azerty2');
//$user->isConnected('john', 'moi@moi.com', 'moi1', 'moi2', 'azerty2');
//$user->getAllInfos('john', 'moi@moi.com', 'moi1', 'moi2', 'azerty2');
//$user->getLogin('john', 'moi@moi.com', 'moi1', 'moi2', 'azerty2');
//$user->getEmail('john', 'moi@moi.com', 'moi1', 'moi2', 'azerty2');
//$user->getFirstname('john', 'moi@moi.com', 'moi1', 'moi2', 'azerty2');
//$user->getLastname('john', 'moi@moi.com', 'moi1', 'moi2', 'azerty2');
?> 