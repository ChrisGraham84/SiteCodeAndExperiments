<?php
      require_once '../config.php';
      if(isset($_GET['companyid']) && intval($_GET['companyid'])){

           $companyid = $_GET['companyid'];
          
           $sql = "SELECT design.designid,designnumber,companyid,description,printposition.name as printposition FROM designprintposition ";
                    $sql .= "LEFT JOIN design on design.designid = designprintposition.designid ";
                    $sql .= "LEFT JOIN printposition on designprintposition.printpositionid = printposition.printpositionid ";
                    $sql .= "WHERE companyid = ? ";
                    
                   
                    if(!($stmt2= $mysqli->prepare($sql))) {
                      echo "Prepare Failed ";
                      echo printf("Errormessage: %s\n", $mysqli->error);
                      echo printf("Errormessage: %s\n", $stmt2->error);
                    }
                    if(!$stmt2->bind_param("s",$companyid)){
                        echo "Binding Param Failed";
                    }

                      $stmt2->execute();
            
                      $result = $stmt2->get_result();
                      if(! $result ||  $result->num_rows <= 0){
                        //echo $companyid;
                      }
                      else{
                          $designs = array();
                          while($row = $result->fetch_assoc())
                          {
                            $designs[] = $row;
                          }
                          // echo var_dump($designs);
                          header('Content-type: application/json');
                          echo "var jdesigns = ".json_encode($designs);
                          
                      }

        }
?>