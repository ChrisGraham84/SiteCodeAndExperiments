<?php
    require_once('globals.php');
    
?>

<html>
    <head>
        <title>Upload An Image</title>
    </head>
    
    <body>
        <div>
            <h3>Upload An Image</h3>
            
            <p>
                <a href="./">View Uploaded Images</a>
            </p>
            
            <?php if(isset($_COOKIE["user"])) {?>
		
                 <form method="post" action="process.php" enctype="multipart/form-data">
                <div>
                    <input type="file" name="image" />
                    <br />
                    <input type="submit" value="Uploade Image" />
                </div>
            </form>
                
	<?php }else
        {
		echo "<b> Please Login to upload an image &nbsp;&nbsp; <a href='login.php'>Login</a>"; 
        }
	?>
        <br />
       <p><a href="index.php">Home</a></p>
        </div>
        
    </body>
</html>