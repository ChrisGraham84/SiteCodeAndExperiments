        <nav class="navbar yamm navbar-default" role="navigation">
            <ul class="nav navbar-nav">
            <li style="border-right:2px solid #000"><a href="#"><?php echo $row["companyname"] ?></a></li>
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
                        <input type="hidden" value="<?php echo $row["gafyid"] ?>" name="companyid">
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
            </ul>
        </nav>