<?php 
   require_once '../config.php';

   if(isset($_GET['companyid']) && intval($_GET['companyid'])){
        
        $companyid = $_GET['companyid'];
        $designid = 0;
        $sql = "";

        //if the design id is sent, use it to filter styles 
        //by print position
        if(isset($_GET['designid']) && intval($_GET['designid']))        {
            $designid = $_GET['designid'];
            
            $sql = "SELECT style.styleid, style.stylenumber,style.gender,style.description, style.manufacturer FROM style ";
            $sql .= "INNER JOIN companystyle on companystyle.styleid = style.styleid ";
            $sql .= "INNER JOIN styleprintposition on styleprintposition.styleid = style.styleid ";
            $sql .= "WHERE styleprintposition.printpositionid IN (SELECT printpositionid from designprintposition where designid = ?) ";
            $sql .= "AND  companystyle.companyid = ?";
        }
        //retrn on company styles
        else
        {
            $sql = "SELECT style.styleid, style.stylenumber,style.gender,style.description, style.manufacturer FROM style ";
            $sql .= "INNER JOIN companystyle on companystyle.styleid = style.styleid ";
            $sql .= "WHERE companystyle.companyid = ?";
        }
      
        if(!($stmt2= $mysqli->prepare($sql))) {
                      echo "Prepare Failed ";
                      echo printf("Errormessage: %s\n", $mysqli->error);
                      echo printf("Errormessage: %s\n", $stmt2->error);
                    }

        if($designid > 0)
        {
                 if(!$stmt2->bind_param("ss",$designid,$companyid)){
                        echo "Binding Param Failed";
                    }
        }
        else
        {
             if(!$stmt2->bind_param("s",$companyid)){
                        echo "Binding Param Failed";
                    }
        }
       
        $stmt2->execute();

        $result = $stmt2->get_result();
        if(! $result ||  $result->num_rows <= 0){
           echo "No Styles Found";
        }
        else{
            $styles = array();
            while($row = $result->fetch_assoc())
            {
            $styles[] = $row;
            }

            header('Content-type: application/json');
            echo json_encode($styles);
        }

   }
  
?>