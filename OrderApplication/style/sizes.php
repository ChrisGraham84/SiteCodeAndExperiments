<?php 
   require_once '../config.php';
   
    if(isset($_GET['styleid']) && intval($_GET['styleid'])){
        
        $styleid = $_GET['styleid'];
        $sql = "";   

        //grab the sizes for the style
        $sql = "SELECT size.sizeid, size.description,sortorder FROM size ";
        $sql .= "JOIN stylesize ss on size.sizeid = ss.sizeid ";
        $sql .= "WHERE ss.styleid = ? ORDER BY sortorder";

        if(!($sizestmt= $mysqli->prepare($sql))){
            echo "Prepare Failed ";
            echo printf("Errormessage: %s\n", $mysqli->error);
            echo printf("Errormessage: %s\n", $stmt2->error);
        }
        if(!$sizestmt->bind_param("s",$styleid)){
            echo "Binding Param Failed";
        }
        $sizestmt->execute();
        $sizeresult = $sizestmt->get_result();
        if(!$sizeresult || $sizeresult->num_rows <= 0){
            echo"No Sizes Found";
        }
        else
        {
            $sizes = array();
            while($size = $sizeresult->fetch_assoc()){
                $sizes[] = $size;
            }

              header('Content-type: application/json');
            echo json_encode($sizes);
        }

    }


?>