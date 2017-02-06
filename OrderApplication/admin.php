  <?php 
   if(isset($_POST["username"]) && isset($_POST["password"])){
       $un = $_POST["username"];
       $pass = $_POST["password"];

        $mysqli = new mysqli("127.0.0.1","chrisush_dev","ph@th3@d","chrisush_GAFYDatabase");
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
        if(!$result || $result->num_rows <= 0){
                echo "Unable to Login,  please try again <a href='index.html'>Back</a>";
        }
        else{
            
            while($row = $result->fetch_assoc()){

           ?>
                <div class="Company">
                    <form method="post" action="orders.php">
                        <input type="submit" value="<?php echo $row["companyname"] ?>">
                        <input type="hidden" value="<?php echo $row["gafyid"] ?>" name="companyid">

                    </form>
                </div>
              
              <?php
            }
        }
   }
   else{
        echo "Unable to Login,  please try again <a href='index.html'>Back</a>";
   }

  ?>