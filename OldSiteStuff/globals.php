<?php
    $db =  mysql_connect("localhost","chrisush_dev","ph@the@d");
    
    if(!$db)
    {
        echo "Unable to Establish Connection To Database Server";
        exit;
    }
    
    if(! mysql_select_db("chrisush_content",$db))
    {
        echo "Unable to connect to database";
        exit;
    }
 
?>