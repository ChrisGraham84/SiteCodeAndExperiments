<?php 
   require_once '../config.php';
   
    if(isset($_GET['styleid']) && intval($_GET['styleid'])){
        
        $styleid = $_GET['styleid'];
        $sql = "";   

          //grab the colors for the style
        $sql = "SELECT color.colorid, color.description, hex FROM color ";
        $sql .= "JOIN stylecolor sc on color.colorid = sc.colorid ";
        $sql .= "WHERE sc.styleid = ? ";

        if(!($colorstmt= $mysqli->prepare($sql))){
            echo "Prepare Failed ";
            echo printf("Errormessage: %s\n", $mysqli->error);
            echo printf("Errormessage: %s\n", $stmt2->error);
        }

        if(!$colorstmt->bind_param("s",$styleid)){
            echo "Binding Param Failed";
        }
        $colorstmt->execute();
        $colorresult = $colorstmt->get_result();
        if(!$colorresult || $colorresult->num_rows <= 0){
            echo"No Colors Found";
        }
        else
        {
            $colors = array();
            
            while($color = $colorresult->fetch_assoc()){
                $colors[] = $color;
            }
            header('Content-type: application/json');
            echo json_encode($colors);
        }
    }


?>