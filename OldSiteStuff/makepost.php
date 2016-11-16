<?php
$posttitle = $_POST["posttitle"];
$postbody = $_POST["postbody"];
$currentuser = $_COOKIE["userid"];
if(!(strlen($posttitle)==0) && !(strlen($postbody)==0) && $currentuser == 2)
{
    $con = mysql_connect("localhost","chrisush_dev","ph@the@d");
    if(!con)
    {
        die("Could Not Connect:" . mysql_error());
    }
    
    $db_selected = mysql_select_db("chrisush_content",$con);
    if(!$db_selected)
    {
        echo "No DB Found.";
    }
    $now = new DateTime;
    $currenttime = $now->format('y/m/d H:i:s');
    //echo $currenttime;
    $sql = "INSERT INTO `Post`(`Title`, `Body`, `DateCreated`, `UserID`, `IsPublished`) VALUES ('". mysql_real_escape_string($posttitle) ."','". mysql_real_escape_string($postbody) ."','". $currenttime."',". $currentuser .",1)";
    mysql_query($sql);
    
    mysql_close($con);
    header("Location: index.php");
}

?>