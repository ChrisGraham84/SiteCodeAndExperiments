<?php
    require_once('globals.php');
    
    try
    {
       
        
        $query = sprintf('select image_id,filename from images');
        $result = mysql_query($query , $db);
        
        $images = array();
        
        if(mysql_num_rows($result) == 0)
        {
            throw new Exception('Image with the specified ID not Found');
        }
        
        while($row = mysql_fetch_array($result))
        {
            $id = $row['image_id'];
            $images[$id] = $row['filename'];
        }
    }
    catch (Exception $ex)
    {
        header('HTTP/1.0 404 Not Found');
        exit;
    }      
?>

<html>
    <head>
        <title>Uploaded Images</title>
    </head>
    <body>
        <div>
            <h1>Uploaded Images</h1>
 
            <p>
                <a href="upload.php">Upload an image</a>
            </p>
 
            <ul>
                <?php if (count($images) == 0) { ?>
                    <li>No uploaded images found</li>
                <?php } else foreach ($images as $id => $filename) { ?>
                    <li>
                        <a href="view.php?id=<?php echo $id ?>">
                            <?php echo htmlSpecialChars($filename)  ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            
            <p><a href="index.php">Home</a></p>
    </body>
</html>