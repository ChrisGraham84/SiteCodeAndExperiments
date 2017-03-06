       <?ob_start();?>
       <?php

        if(!isset($_POST['companyid'])) {
            echo "An Error has occured, Please return to the <a href='index.html'>login</a>";
        }
        else{
            ?>
             <!DOCTYPE html>
	            <head>
                    <title>Order Application</title>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <script type='text/javascript' src='js/knockout-3.4.0.js'></script>
                    <script type='text/javascript' src='js/knockout.mapping-latest.js'></script>
                    <script type='text/javascript' src='js/knockout.validation.js'></script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                    <script type='text/javascript' src='js/services.js'></script>
                    <script type='text/javascript' src='js/clientfiles/<?php echo $_POST['companyid']; ?>_styledesigns.js'></script>
                    <link href="css/bootstrap.min.css" rel="stylesheet">
                    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
                    <link href="yamm/yamm.css" rel="stylesheet">
                  <link href="css/demo.css" rel="stylesheet">
	            </head>
                <nav class="navbar yamm navbar-default" role="navigation">
            <ul class="nav navbar-nav">
            <li style="border-right:2px solid #000"><a href="admin.php"  data-bind="text: companyName"></a></li>
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
                                <input type="hidden" value="" name="companyid">
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
               <body role="document">
                    <style>
                        td {padding:5px 5px;}
                        input {width:215px;}
                    </style>
        
                    <div class="container theme-showcase" role="main">
                        <div>
                            <h2>
                                Manage Orders
                            </h2>
                        
                        </div>
                        <div data-bind="visible: orders().length > 0">
                                <ul class="pagination" data-bind="foreach: orders">
                                    <li>
                                        <span data-bind="text: $data.orderId, click: goToOrder"></span>
                                    </li>    
                                </ul>
                                
                        </div>
                        
                        <br />
                        <br />
                        <div class="container" data-bind="with: choseOrder">
                            <table class="table">   
                                    <tr>
                                        <td><button class="btn btn-primary" data-bind="click: removeOrder">Remove Order</button></td>
                                    </tr>              
                                    <tr>                       
                                        <td><input class="form-control" placeholder="Order ID" data-bind="value: orderId" /></td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-control" placeholder="First Name" data-bind="value: firstName" /></td>
                                        <td><input class="form-control" placeholder="Last Name" data-bind="value: lastName" /></td>
                                        <td><input class="form-control" placeholder="Email" data-bind="value: email" /></td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-control" placeholder="Address 1" data-bind="value: address1" /></td>
                                        <td><input class="form-control" placeholder="Address 2" data-bind="value: address2" /></td>
                                        <td><input class="form-control" placeholder="City" data-bind="value: city" /></td>
                                        <td><input class="form-control" placeholder="State"  style="width:100px;" data-bind="value: state" /></td>
                                        <td><select class="form-control" data-bind="options: country, value: countryValue"></td>
                                        <td><input id="zipcode" class="form-control" placeholder="Zip" style="width:100px;" data-bind="value: zip" /></select></td>
                                        <td class="checkbox"><label><input id="zipnotrequired" type="checkbox"/><span style="font-size:8pt">Not Required</span></label></td>
                                        <script>
                                            $('#zipnotrequired').click(function(){
                                                    var zipcode = $('#zipcode');
                                                    if(this.checked){
                                                        zipcode.prop('disabled', true);
                                                    }
                                                    else{
                                                        zipcode.prop('disabled',false);
                                                    }
                                                });
                                        </script>
                                    </tr>
                                    <tr>
                                    <td><select class="form-control" data-bind="options: shipping, value: shippingValue"></select></td>
                                    <td><select class="form-control" data-bind="options: insured, value: insuredValue"></select></td>
                                        <td><textarea class="form-control" placeholder="Gift Message" data-bind="value: giftMessage"></textarea></td>
                                    </tr>
                                </table>
                                <button class="btn btn-primary" data-bind="click: addItem">Add Item</button>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sort By</th>
                                            <th>Design</th>
                                            <th>Style</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th width="10%">Quantity</th>
                                            <th>Remove</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody data-bind="foreach: items">
                                        <tr>
                                            <td><select class="form-control" style="width:110%;" data-bind="options:headers, value:activeSort, optionsText:'title'"></select></td>
                                            <td><select class="form-control" data-bind="options: sortedDesigns, optionsText: function(i) { return $data.displayName(i.designid,i.name,i.printposition) }, optionsCaption: 'Select..', value: designValue"></select></td>
                                            <td><select  class="form-control" data-bind='options: styles, optionsText:function(i) { return i.stylenumber + " - " + i.name },optionsCaption: "Select..", value: styleValue'></select></td>
                                            <td data-bind="with: styleValue"><select  class="form-control" data-bind="options: colors, optionsText: 'name', optionsCaption: 'Select..', value: $parent.colorValue "></select></td>
                                            <td data-bind="with: styleValue"><select  class="form-control" data-bind="options: sizes, optionsText: 'name', optionsCaption: 'Select..', value: $parent.sizeValue "></td>
                                            <td ><input style="width:30%;" data-bind="value: quantity"/></td>
                                            <td><a href="#" data-bind="click: $parent.removeItem">Remove</a></td>
                                        </tr>
                                        <tr>

                                        </tr>
                                    </tbody>
                                </table>                
                                <br />
                                <br />                 
                        </div>
                        <div style="float:right">
                            <button class="btn btn-primary" data-bind="click: addOrder">Save Order</button>
                            <br />
                            <br />
                             <button data-bind="click: send">Send Orders</button>
                        </div>
                       
                        <br />
                        <br />
                        <div style="clear:both">
                            <a href="index.html">Back</a>
                        </div>
                    </div>
		            <script src="js/bootstrap.min.js"></script>
	            </body>
            </html>
                    
<?php
        }    
?>

