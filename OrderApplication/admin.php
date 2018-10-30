  
        <html>
        <head>
            <title>Admin</title>
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <script type='text/javascript' src='js/knockout-3.4.0.js'></script>
              <script type='text/javascript' src='js/knockout.mapping-latest.js'></script>
              <script type='text/javascript' src='js/knockout.validation.js'></script>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
              <link href="css/bootstrap.min.css" rel="stylesheet">
              <link href="css/bootstrap-theme.min.css" rel="stylesheet">
              <link href="yamm/yamm.css" rel="stylesheet">
              <link href="css/demo.css" rel="stylesheet">
        </head>
        <body>
        
        <?php include dirname(__FILE__) .'/clientnav.php' ?>
        <?php  if($companyid && $companyname){    ?>
        <div class="container" >
          <!--<h2>Open Orders:</h2>
          <div class="row">
            <div class="col-md-12">
              <p style="background-color:pink">Order : 10018 | 3 Items</p>
            </div>
          </div> -->
          <h2>Designs </h2>
          <div class="row">
            <div class="col-md-12">
              <select class="form-control">
                  <?php
                    $sql = "SELECT * ";
                    $sql .= "FROM  Design ";
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
                         // echo "There has been an error please go <a href='index.html'>Back</a>";
                      }
                      else{
                          while($row = $result->fetch_assoc())
                          {
                            echo "<option value=".$row["designnumber"]."> ".$row["description"]." - ".$row['designnumber']."</option>";
                          }
                      }
                  ?>
              </select>
            </div>
          </div>
          <h2>Styles</h2>
            <div class="row">
              <div class="col-md-4">
                <label>Styles</label>
                <select class="form-control">
                   
                  <?php 
                      $sql = "SELECT style.stylenumber, style.styleid, style.description FROM style ";
                      $sql .= "INNER JOIN companystyle ON companystyle.styleid = style.styleid ";
                      $sql .= "WHERE companystyle.companyid = ? ORDER BY manufacturer";
                      $stmt;
                      if(!($stmt= $mysqli->prepare($sql))) {
                          echo "Prepare Failed ";
                        echo printf("<br />Errormessage: %s\n", $mysqli->error);
                        echo printf("<br />Errormessage: %s\n", $stmt->error);
                      }
                      if(!$stmt->bind_param("s",$companyid)){
                          echo "Binding Param Failed";
                      }
                      $stmt->execute();
                      $result = $stmt->get_result();

                     
                      if(! $result ||  $result->num_rows <= 0){
                          echo "No Brands Found";
                        }
                        else{
                            while($row = $result->fetch_assoc())
                            {
                              echo "<option value=".$row["styleid"]."> ".$row["stylenumber"]." | ".$row["description"]."</option>";
                            }
                        }
                      
                      
                  ?>
                
                </select>             
              </div>
              <div class="col-md-8">
                <div class="col-md-3">
                    <div id="shirtTemplate" style="background-color:white">
                      <img src="img/crew_front.png" style="height:25%;width:110%" />
                      
                    </div>
                    <br />
                      <p>Print Location - Back_Front</p>
                  </div>
                  <div class="col-md-9" style="font-size:9pt">
                     <p>Colors</p>
                     <div>
                       <span class="swatch" style="background-color: rgb(241,240,245);"></span>
                       <span class="swatch" style="background-color: rgb(0,245,0);"></span>
                       <span class="swatch" style="background-color: rgb(0,0,245);"></span>
                       <span class="swatch" style="background-color: rgb(245,0,0);"></span>
                     </div>
                     <hr />
                     <p>Sizes</p>
                    <div class="col-md-1">
                      S<br /> $1.00
                    </div>
                    <div class="col-md-1">
                      M<br />$1.00
                    </div>
                    <div class="col-md-1">
                      L<br />$1.00
                    </div>
                    <div class="col-md-1">
                      XL<br />$1.00
                    </div>
                    <div class="col-md-1">
                      XXL<br />$1.00
                    </div>
                    <div class="col-md-1">
                      3XL<br />$1.00
                    </div>
                    <div class="col-md-1">
                      4XL<br />$1.00
                    </div>
                    <div class="col-md-1">
                      5XL<br />$1.00
                    </div>
                  </div>
              </div>
            </div>
        </div>
         <style>
        .swatch{
            width:15px;
            height:15px;
            margin: 2px 5px 0 0;
            position: relative;
            display: inline-block;
            cursor: pointer;
        }
        </style>
        <script>
           $(document).ready(function() {
            $(".swatch").click(function(swatch){
                //alert($(this).css("background-color"));
                $("#shirtTemplate").css("background-color", $(this).css("background-color"));
            });

         
            });
        </script>

        <script src="js/bootstrap.min.js"></script>
            </body>
            </html>
            <?php
   }
   else{

        echo $_COOKIE['username'];
        echo "Unable to Login,  please try again <a href='index.html'>Back</a>";
   }

  ?>