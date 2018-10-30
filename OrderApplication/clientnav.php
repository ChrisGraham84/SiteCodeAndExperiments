        <?php
        require_once dirname(__FILE__) .'/config.php';

        if(isset($_COOKIE['username']) && isset($_COOKIE['userid'])){
       $username = $_COOKIE['username'];
       $userid = $_COOKIE['userid'];

        
        $sql = "SELECT Company.companyname,Company.gafyid,Company.companyid,Company.canpickup,Company.Companycontactemail ";
        $sql .= "FROM  `Company` ";
        $sql .= "JOIN CompanyUser ON Company.companyid = CompanyUser.companyid ";
        $sql .= "JOIN User ON CompanyUser.userid = User.userid ";
        $sql .= "WHERE User.userid = ? ";

        if(!($stmt= $mysqli->prepare($sql))) {
            echo "Prepare Failed";
            echo printf("Errormessage: %s\n", $mysqli->error);
        }
        if(!$stmt->bind_param("s",$userid)){
            echo "Binding Param Failed";
        }

        $stmt->execute();
        
         $result = $stmt->get_result();
        if(! $result ||  $result->num_rows <= 0){
                echo "There has been an error please go <a href='index.html'>Back</a>";
        }
        else{
              $row = $result->fetch_assoc();
              $companyid = $row["companyid"];
              $companyname = $row["companyname"];
              $canpickup = $row["canpickup"];
              $gafyid = $row["gafyid"];
              $email = $row["Companycontactemail"];
            ?>
        
        
        <nav class="navbar yamm navbar-default" role="navigation">
            <ul class="nav navbar-nav">
            <li style="border-right:2px solid #000"><a href="admin.php"><?php echo $companyname ?></a></li>
            <li><a href="#">Styles</a></li>
            <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Orders<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li>
                  <!-- Content container to add padding -->
                  <div class="yamm-content">
                    <div class="row">
                      <ul class="col-sm-2 list-unstyled">
                        <li>
                           <form method="post" action="orders.php">
                        <input type="submit" class="btn btn-info" value="Manage Orders">
                    </form>

                        </li>
                        <li><a href="#"> Archived Orders </a></li>
                      </ul>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Designs<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li>
                  <!-- Content container to add padding -->
                  <div class="yamm-content">
                    <div class="row">
                      <ul class="col-sm-2 list-unstyled">
                        <li><a href="#">Release New Design </a></li>
                        <li><a href="#"> Existing Designs </a></li>
                        <li><a href="#"> Update Designs </a></li>
                        
                      </ul>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Fullfillment<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li>
                  <!-- Content container to add padding -->
                  <div class="yamm-content">
                    <div class="row">
                      <ul class="col-sm-2 list-unstyled">
                        <li><a href="#">Email </a></li>
                        <li><a href="#"> Design Placement</a></li>
                        <li><a href="#">Image Software Toolkit</a></li>
                        <li><a href="#">Design Templates</a></li>
                        <li><a href="#">Blank Images & Size Charts</a></li>
                        <li><a href="#">Miscellaneous Fulfillment Pricing</a></li>
                        <li><a href="#">Photoshop Tutorial</a></li>
                        <li><a href="#">Non-Guaranteed Fulfillment Items</a></li>
                        <li><a href="#">Holiday Schedule</a></li>
                        <li><a href="#">Product Image Creation (Mock-Ups)</a></li>
                        <li><a href="#">Color Swatches</a></li>
                        <li><a href="#">Shipping & Handling Charges</a></li>
                        <li><a href="#">SKUs for eCommerce Automation</a></li>
                      </ul>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <li style="float:right;"><a href="index.html">Logout</a></li>
            </ul>
        </nav>

        <?php }} ?>