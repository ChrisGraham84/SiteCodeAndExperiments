<?
include 'recentpost.php';
?>

<!DOCTYPE HTML>
<html>
   
        <title>New Site Redesign</title>
        <link rel="stylesheet" href="main.css">
   
        <div id="container">
           <div id="header">
                <h1> Deconstruction Developments</h1>
                <h3>The Personal Website of christopher E. graham</h3>
           </div>
            <div id="topNav">
                    <ul>
                        <li>
                            <a class="current" href="index.php">Home</a>
                        </li>
                       <!-- <li>
                            <a href="words.php">Words</a>
                        </li>
                        <li>
                            <a href="images.php">Images</a>
                        </li>-->
                        <li>
                            <a href="bio.php">Bio</a>
                        </li>
                     
                    </ul>
                </div>
            <div id="content">
               
                <?
                $arrayCount = count($aryPost);
                if($arrayCount > 0)
                {
                        
                        foreach($aryPost as $key => $value)
                        {
                                echo "<div class=\"postText\" > <div class=\"postContents\">";
                             
                                echo "<h2>" . $value->title . "</h2>";
                                echo "<h3>" . $value->body . "</h3>";
                                        
                                echo "<div class=\"postinfo\"> Posted By:". $value->user . "</br >";
                                echo "Posted: ". date_format($value->date,'Y/m/d') . "</div >";
                                        
                                if(isset($_COOKIE["user"]))
                                {
                                        echo "<br><a href='createpost.php'>Make a Post</a>";
                                }
                            
                               echo "</div> </div>";
                        }
                }
                
                else{ 
                        echo "<div class=\"postText\" > <div class=\"postContents\">";
                        echo $error;
                        if(isset($_COOKIE["user"]))
                        {
                                echo "<br><a href='../createpost.php'>Make a Post</a>";
                        }
                        echo "</div> </div>";
                  }?>
                
			
                        
            </div>
            <div id="footer"></div>
        </div>

</html>