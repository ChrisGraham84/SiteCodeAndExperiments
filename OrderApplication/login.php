<?php
@ob_start();
require_once dirname(__FILE__) .'/config.php';

if(isset($_POST['username']) && isset($_POST['password']))
{
    session_start();
    $username = $_POST['username']; 
    $password = $_POST['password'];

    $sql = "SELECT userid,username ";
    $sql .= "FROM  `user` ";
    $sql .= "WHERE username = ? AND pass = ? ";
   
    if(!($stmt= $mysqli->prepare($sql))) {
        echo "Prepare Failed";
        echo printf("Errormessage: %s\n", $mysqli->error);
    }
    if(!$stmt->bind_param("ss",$username,$password)){
        echo "Binding Param Failed";
    }

    $stmt->execute();
    
    $result = $stmt->bind_result($userid,$username);
    while($stmt->fetch()){
        echo 1;
        //$row = $result->fetch_assoc();
        //echo $row['userid'];
        setcookie('username', $username);
        setcookie('userid', $userid);
        //echo $_COOKIE['username'];
    }
}




?>