  <?php 
  
   if(isset($_POST["username"]) && isset($_POST["password"])){
       $un = $_POST["username"];
       $pass = $_POST["password"];

        $mysqli = new mysqli("127.0.0.1","root","","chrisush_GAFYDatabase");
        if($mysqli->connect_errno){
           echo "Sorry, this website is experiencing problems.";

           echo "Error: Failed to make a MySQL connection, here is why: \n";
            echo "Errno: " . $mysqli->connect_errno . "\n";
            echo "Error: " . $mysqli->connect_error . "\n";
        }
         $sql = "SELECT Company.companyname,Company.gafyid ";
        $sql .= "FROM  `Company` ";
        $sql .= "JOIN CompanyUser ON Company.companyid = CompanyUser.companyid ";
        $sql .= "JOIN User ON CompanyUser.userid = User.userid ";
        $sql .= "WHERE User.username = ? AND User.pass = ? ";

        if(!($stmt= $mysqli->prepare($sql))) {
            echo "Prepare Failed";
            echo printf("Errormessage: %s\n", $mysqli->error);
        }
        if(!$stmt->bind_param("ss",$un,$pass)){
            echo "Binding Param Failed";
        }

        $stmt->execute();
        
         $result = $stmt->get_result();
        if(!$_SESSION['username']){
          echo $_SESSION['username']."session";
                echo "Unable to Login,  please try again <a href='index.html'>Back</a>";
        }
        else{

            while($row = $result->fetch_assoc()){
            ?>
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
        
        <?php include 'clientnav.php' ?>
        <div class="container" >
          <h2>Open Orders:</h2>
            <div class="row">
            <div class="col-md-12">
              <p style="background-color:pink">Order : 10018 | 3 Items</p>
            </div>
            </div>
          <h2>Styles</h2>
            <div class="row">
              <div class="col-md-4">
                <label>Brands</label>
                <select class="form-control">
                    <option value="Gildan">Gildan</option>
                </select>
                <br />
                <label>Styles</label>
                <select class="form-control">
                    <option value="g2000">G2000 - Ultra Cotten Tee</option>
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
   }
   }
   else{

        echo $_COOKIE['username'];
        echo "Unable to Login,  please try again <a href='index.html'>Back</a>";
   }

  ?>