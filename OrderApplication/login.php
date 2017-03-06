<?php
require_once 'config.php';

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
    
    $result = $stmt->get_result();
    if(!$result || $result->num_rows <= 0){
        
        echo 0;
    }
    else
    {
        echo 1;
        $row = $result->fetch_assoc();
        //echo $row['userid'];
        setcookie('username', $row['username'], false, '/orderapplication','localhost');
        setcookie('userid', $row['userid'], false, '/orderapplication','localhost');
        //echo $_COOKIE['username'];
    }
}




?>