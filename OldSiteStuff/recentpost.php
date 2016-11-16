<?
include 'postobject.php';

$aryPost = array();

$userid=0;
$error = "";
//$title = "";
//$body = "";
//$date = "";
//$user = "";
$con = mysql_connect("localhost","chrisush_dev","ph@the@d");
if(!$con)
{
        die('Could Not Connect:' . mysql_error());
}
$db_selected = mysql_select_db("chrisush_content",$con);
if(!$db_selected)
{
        $error = "No DB Found.";
}
$sql = "SELECT `ID`,`Name` FROM `User` WHERE `Email` = 'ushi84@gmail.com'";
$result = mysql_query($sql);
if(!$result || mysql_num_rows($result) <= 0)
    {
          $error = "Unable to locate user";
    }
else
{
    while($row = mysql_fetch_array($result))
    {
            //$name = $row['Name'];
            $userid = $row["ID"];
            $user = $row["Name"];
    }
}

if($userid != 0)
{
    $psql = "SELECT * FROM `Post` WHERE `UserID`  = ". $userid ." AND `IsPublished` = 1 ORDER BY DateCreated DESC";
    $postresult = mysql_query($psql);
    if(!$postresult || mysql_num_rows($postresult) <= 0)
    {
       $error = "No Posts";
    }
    else
    {
        //$postrow = mysql_fetch_array($postresult);
       
         while($postrow = mysql_fetch_array($postresult))
        {
                
                $title = $postrow["Title"];
                $newpost = new cpost;
                $newpost->title = $postrow["Title"];
                $newpost->body = $postrow["Body"];
                $newpost->date =  date_create( $postrow["DateCreated"]);
                $newpost->user = $user;
                
                $aryPost[$title] = $newpost;
        }
        
        
       // $title = $postrow["Title"];
        //$body = $postrow["Body"];
        //$date = date_create( $postrow["DateCreated"]);
        //$title = $postrow["Title"];
        
    }
}
mysql_close($con);
?>