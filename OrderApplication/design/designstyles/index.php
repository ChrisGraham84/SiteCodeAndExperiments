<?php
     require_once 'config.php';
    if(isset($_GET['companyid']) && intval($_GET['companyid'])){
          $companyid = $_GET['companyid'];

        //SQL for the intial designs based on a company id
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
        
        }
        else{
            $designs = array();
            while($design = $result->fetch_assoc())
            {
             
            $designid = $design['designid'];

            //sql to grab the styles and associate them with designs that have he same print positions
            $sql = "SELECT style.styleid, style.stylenumber,style.gender,style.description, style.manufacturer FROM style ";
            $sql .= "INNER JOIN companystyle on companystyle.styleid = style.styleid ";
            $sql .= "INNER JOIN styleprintposition on styleprintposition.styleid = style.styleid ";
            $sql .= "WHERE styleprintposition.printpositionid IN (SELECT printpositionid from designprintposition where designid = ?) ";
            $sql .= "AND  companystyle.companyid = ?";

            if(!($stmt2= $mysqli->prepare($sql))) {
                echo "Prepare Failed ";
                echo printf("Errormessage: %s\n", $mysqli->error);
                echo printf("Errormessage: %s\n", $stmt2->error);
            }

                if(!$stmt2->bind_param("ss",$designid,$companyid)){
                echo "Binding Param Failed";
            }

                $stmt2->execute();

            $styleresult = $stmt2->get_result();
            if(! $styleresult ||  $styleresult->num_rows <= 0){
                echo "No Styles Found";
            }
            else{
                $styles = array();
                while($style = $styleresult->fetch_assoc()){
                
                    $styleid = $style["styleid"];

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
                            $colors[] = array('color'=> $color);
                           
                        }
                    }

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
                            $sizes[] = array('size'=> $size);
                            //echo $size["description"];
                            //echo "<br />";
                        }
                    }

                    $styles[] = array('style' => $style, 'colors'=>$colors,'sizes' => $sizes);
                }
                
            }
               $designs[] = array('design' => $design, 'styles' => $styles);
          }
            
            header('Content-type: application/json');
            echo "var jdesignstyles = ".json_encode($designs);
        }

    }
?>