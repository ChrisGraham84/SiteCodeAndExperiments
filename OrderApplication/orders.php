       <?ob_start();?>

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
                    
                    <link href="css/bootstrap.min.css" rel="stylesheet">
                    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
                    <link href="yamm/yamm.css" rel="stylesheet">
                  <link href="css/demo.css" rel="stylesheet">
	            </head>
                <?php include dirname(__FILE__) .'/clientnav.php' ?>
                <?php  if($companyid && $companyname){    ?>
                <!--<script type='text/javascript' src='js/clientfiles/<?php echo $gafyid ?>_styledesigns.js'></script>-->
                <script type='text/javascript' src='./design/index.php?companyid=<?php echo $companyid ?>'></script>
                <script type='text/javascript'>
                        $(document).ready(function() {
                            companyid = <?php echo $companyid ?>;
                            var vm = companyModel('<?php echo $companyname ?>','<?php echo $companyid ?>','<?php echo $email ?>')
                            ko.applyBindings(vm);
                        
                        });

                </script>
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
                        <style>
                            .form-control{margin:2px;}
                            #AddressInfo .row {margin:0px 0px;}
                        </style>
                        <div class="container" data-bind="with: choseOrder">
                        <div class="row"><button class="btn btn-primary" data-bind="click: removeOrder">Remove Order</button></div>
                        <div class="row">
                            <!--Customer Info -->
                            <div class="col-md-4">
                              <div class="row"><input class="form-control" placeholder="Order ID" data-bind="value: orderId" /></div>
                              <div class="row"><input class="form-control" placeholder="First Name" data-bind="value: firstName" /></div>
                              <div class="row"><input class="form-control" placeholder="Last Name" data-bind="value: lastName" /></div>
                              <div class="row"><input class="form-control" placeholder="Email" data-bind="value: email" /></div>
                                <?php if($canpickup){ ?>
                                        <div class="row"><label><input id="pickup" type="checkbox"/><span style="font-size:8pt">Pick Up</span></label></div>
                                          <script>
                                            $('#pickup').click(function(){
                                                    var zipcode = $('#AddressInfo');
                                                    if(this.checked){
                                                        zipcode.hide();
                                                    }
                                                    else{
                                                        zipcode.show();
                                                    }
                                                });
                                        </script>
                                       <?php } ?>
                            </div>
                            <!-- Customer Address Info -->
                            <div class="col-md-4" id="AddressInfo">
                                <div class="row"><input class="form-control" placeholder="Address 1" data-bind="value: address1" /></div>
                                <div class="row"><input class="form-control" placeholder="Address 2" data-bind="value: address2" /></div>
                                <div class="row"><input class="form-control" placeholder="City" data-bind="value: city" /></div>
                                <div class="row"><input class="form-control" placeholder="State"  style="width:100px;" data-bind="value: state" /></div>
                                <div class="row"><select class="form-control" data-bind="options: country, value: countryValue"></select></div>
                                <div class="row">
                                    <input id="zipcode" class="form-control" placeholder="Zip" style="width:100px;" data-bind="value: zip" />
                                    <label><input class="form-control" style="height:12px;" id="zipnotrequired" type="checkbox"/><span style="font-size:8pt">Not Required</span></label>
                                </div>
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
                            </div>
                            <!--Shipping/Misc Info -->
                            <div class="col-md-4">
                                <div class="row"><select class="form-control" data-bind="options: shipping, value: shippingValue"></select></div>
                                <div class="row"><select class="form-control" data-bind="options: insured, value: insuredValue"></select></div>
                                <div class="row"><textarea class="form-control" placeholder="Gift Message" data-bind="value: giftMessage"></textarea></div>
                            </div>
                        </div>
                        <div class="row"> <button class="btn btn-primary" data-bind="click: addItem">Add Item</button>
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
                                            <td><select class="form-control" style="width:110%;" data-bind="options:headers, value: activeSort, optionsText:'title'"></select></td>
                                            <td><select class="form-control" data-bind="options: sortedDesigns , optionsText: function(i) { return displayName(i.designnumber,i.description,i.printposition) }, optionsCaption: 'Select...', value: designValue"></select></td>
                                            <td><select class="form-control" data-bind='options: styles, optionsText:function(i) { return i.stylenumber + " - " + i.description },optionsCaption: "Select..", value: styleValue'></select></td>-
                                            <td><select  class="form-control" data-bind="options: colors, optionsText: function(i){ return i.description }, optionsCaption: 'Select..', value: colorValue "></select></td>
                                            <td><select  class="form-control" data-bind="options: sizes, optionsText:  function(i){ return i.description }, optionsCaption: 'Select..', value: sizeValue "></td>
                                            <td ><input style="width:30%;" data-bind="value: quantity"/></td>
                                            <td><a href="#" data-bind="click: $parent.removeItem">Remove</a></td>
                                        </tr>
                                        <tr>

                                        </tr>
                                    </tbody>
                                </table>    
                        </div>            
                                <br />
                                <br />                 
                        </div>
                        <div style="float:right">
                            <button class="btn btn-primary" data-bind="click: addOrder">Add Order</button>
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

