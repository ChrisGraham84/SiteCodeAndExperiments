       <?ob_start();?>
       <?

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
	            </head>     
               <body role="document">
                    <style>
                        td {padding:5px 5px;}
                        input {width:215px;}
                    </style>
        
                    <div class="container theme-showcase" role="main">
                        <div>
                            <h2>
                                <p>Company: <strong  data-bind="text: companyName"></strong></p>
                                <p><small>Comapny ID: <strong  data-bind="text: companyID"></strong></small></p>
                            </h2>
                        
                        </div>
                        <div data-bind="visible: orders().length > 0">
                                <ul class="pagination" data-bind="foreach: orders">
                                    <li>
                                        <span data-bind="text: $data.orderId, click: goToOrder"></span>
                                    </li>    
                                </ul>
                                
                        </div>
                        <div>
                            <button class="btn btn-primary" data-bind="click: addOrder">New Order</button>
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
                                        <td><select class="form-control" data-bind="options: country, optionsCaption: 'Country...', value: countryValue"></select></td>
                                        <td><input class="form-control" placeholder="Zip" style="width:100px;" data-bind="value: zip" /></td>
                                    </tr>
                                    <tr>
                                    <td><select class="form-control" data-bind="options: shipping, value: shippingValue, optionsCaption: 'Shipping Method...'"></select></td>
                                    <td><select class="form-control" data-bind="options: insured, value: insuredValue, optionsCaption: 'Insured...'"></select></td>
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
                                            <td><select  class="form-control" data-bind='options: styles, optionsText: "name",optionsCaption: "Select..", value: styleValue'></select></td>
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
                        <button data-bind="click: send">Send Orders</button>
                        <br />
                        <br />
                        <a href="index.html">Back</a>
                    </div>
		            <script src="js/bootstrap.min.js"></script>
	            </body>
            </html>
                    
<?php
        }
?>

