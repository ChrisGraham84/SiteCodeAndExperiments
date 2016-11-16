<?php
 require_once('globals.php');
 function assertValidUpload($code)
 {
    if($code == UPLOAD_ERR_OK)
    {
        return;
    }
    
    switch($code)
    {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            $msg = 'Image is too Large';
            break;
        
        case UPLOAD_ERR_PARTIAL:
            $msg = 'Image was only partially uploaded';
            break;
        
        case UPLOAD_ERR_NO_FILE:
            $msg = 'No image was uploaded1';
            break;
        
        case UPLOAD_ERR_NO_TMP_DIR:
            $msg = 'Upload Folder not found';
            break;
        
        case UPLOAD_ERR_CANT_WRITE:
            $msg = 'Unable to Write upload file';
            break;
        
        case UPLOAD_ERR_EXTENSION:
            $msg = 'Upload failed due to exstension';
            break;
        
        default:
            $msg = 'Uknown Error';
            break;
    }
    throw new Exception($msg);
 }
$errors = array();

try
{
    if(!array_key_exists('image', $_FILES))
    {
        throw new ex('Image not found in uploaded Data');
    }
    
    $image = $_FILES['image'];
    
    //ensure the file was successfully uploaded
    assertValidUpload($image['error']);
    
    if(!is_uploaded_file($image['tmp_name']))
    {
        throw new Exception('File is not an uploaded file');
    }
    
    $info = getimagesize($image['tmp_name']);
    
    if(!$info)
    {
        throw new ex('File is not an image');
    }
}
catch (Exception $ex)
{
    echo 'blahblah';
    $errors = $ex->getMessage();
}

if(count($errors)== 0)
{
    //no errors, so insert the image
    
    $query = sprintf(
        "insert into images (filename, mime_type, file_size, file_data) values ('%s','%s','%d','%s')",
        mysql_real_escape_string($image['name']),
        mysql_real_escape_string($image['mime']),
        $image['size'],
        mysql_real_escape_string(file_get_contents($image['tmp_name']))
    );
    
    mysql_query($query,$db);
    
    $id=(int) mysql_insert_id($db);
    
    //finally redirect the user to view the new image
    header('Location: view.php?id='. $id);
    exit;
}
?>

<html>
    <head>
        <title>Error</title>
    </head>
    <body>
        <div>
            <p>
                The following errors occurred:
            </p>
 
            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li>
                        <?php echo htmlSpecialChars($error) ?>
                    </li>
                <?php } ?>
            </ul>
 
            <p>
                <a href="upload.php">Try again</a>
            </p>
        </div>
    </body>
</html>