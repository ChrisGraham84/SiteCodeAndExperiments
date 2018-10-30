

function companyModel(name,id,email) {
    var self = this;
    this.companyID = id;
    this.companyName = name;
    this.email = email;
    self.orders = ko.observableArray([new orderModel(1)]);
    self.choseOrder = ko.observable();
    self.clientdesigns = ko.observableArray(jdesigns);
    self.headers = ko.observableArray([{title :'Name',sortType: 'name', asc: false, active: true},{title :'ID',sortType: 'designId', asc: false, active: true}]);

    self.activeSort = ko.observable(self.headers()[0]);
    self.sortMethod = ko.pureComputed(function(){
                var header = self.activeSort();
                switch (header.sortType) {
            case 'name':
            var descSort = function(left, right) {
                return (left.description) == (right.description) ? 0 : ((left.description) < (right.description) ? -1 : 1)
            };
            var ascSort = function(left, right) {
                return (left.description) == (right.description) ? 0 : ((left.description) > (right.description) ? -1 : 1)
            };
            //this.displayName = function() {return i.design.name + '-' + i.design.designid + ' | ' + i.design.printposition}
            return header.asc ? ascSort : descSort;
            case 'designId':
            var descSort = function(left, right) {
                return (left.designid) == (right.designid) ? 0 : ((left.designid) < (right.designid) ? -1 : 1)
            };
            var ascSort = function(left, right) {
                return (left.designid) == (right.designid) ? 0 : ((left.designid) > (right.designid) ? -1 : 1)
            };
            return header.asc ? ascSort : descSort;
            };
        });
        
    self.sortedDesigns = ko.pureComputed(function(){
        return self.clientdesigns().sort(self.sortMethod());
    });
    self.displayName = function(id,name,location){
           var header = self.activeSort();
             switch (header.sortType) {
        case 'name':
             return name + '-' + id + ' | ' + location;
        case 'designId':
             return id + '-' + name + ' | ' + location;
             };
    };
    
    //methods
    self.addOrder = function () { 
       
        
        //validate order
         if(self.validate()){
            //save order
        
            //creat new order
            var order = new orderModel(self.orders().length + 1);
            self.orders.push(order);
            self.choseOrder(order);
        }
        else
        {
            alert("Current Order Must Be Valid To Create Another")
        }

        
    }
    self.removeOrder = function (order) { 
        if(self.orders().length > 1) { 
            self.orders.remove(order)}
            self.choseOrder(self.orders()[0]);
     };
    self.goToOrder = function(order) {
       //onsole.log(self.orders()[arrayIndx]);
        self.choseOrder(order);
    };
    //console.log(self.orders()[0]);
    self.goToOrder(self.orders()[0]);

      self.send = function(){ 
           
           if(this.validate())
           {
                var vm = {
                    company : {
                    name : this.companyName,
                    id: this.companyID,
                    email: this.email,
                    orders : this.orders
                    }
                }
                
                //console.log(ko.toJSON(vm))

                var data = ko.toJSON(vm);
                var postData = $.ajax({
                    url:"./download.php",
                    type: "POST",
                    data: data,
                    datatype: "json",
                    processData: false,
                    contentType: "application/json; charset=utf-8",
                    success: function(result){
                        console.log(result);
                        //var form = $('<form method="POST" action="downloader.php">');
                        //form.append($('<input type="hidden" name="ords" value="' + encodeURIComponent(JSON.stringify(data)) + '" />'))
                        //$('body').append(form);
                        //form.submit();
                        if(result.indexOf("Message has been sent" >= 0))
                        {
                            alert("Your Message Has Been Sent.")
                           // self.orders = ko.observableArray([new orderModel(1)]);
                        }
                    }
                });
                
                postData.error(function() { alert("something went wrong"); })
         }  
         else
         {
             alert("There are fields are empty, all fields except Gift Messgae must be filled. Quantities must be greater than 0");
         }
    };

    self.validate = function(){
           
           var validate = true;
           if(self.orders().length < 1){validate = false;}
           self.orders().forEach(function(order){
               console.log(order);
               if(order.orderId().length < 1){ validate = false;}
               if(order.firstName().length < 1){validate =  false;}
               if(order.lastName().length < 1){validate =  false;}
               if(order.address1().length < 1){validate = false;}
               if(order.city().length < 1){validate = false;}
               if(order.state().length < 1){validate = false;}
               if(order.zip().length < 1){validate = false;}
               if(order.email().length < 1){validate = false;}
               if(!order.countryValue()){validate = false;}
               if(!order.insuredValue()){validate = false;}
               if(!order.shippingValue()){validate = false;}  

               if(order.items().length < 1){validate = false;}
               order.items().forEach(function(item){
                  
                   if(!item.designValue()){validate = false;}
                   if(!item.styleValue()){validate = false;}
                   if(!item.colorValue()){validate = false;}
                   if(!item.sizeValue()){validate = false;}
                   if(item.quantity < 1){validate = false;}
               });
             
           });
          return validate;
        }
};


function orderModel(count) {
    var self = this;
    var date = new Date();
    this.orderId = ko.observable( date.now() + "-" + count);
    this.firstName = ko.observable("");
    this.lastName = ko.observable("");
    this.address1 = ko.observable("");
    this.address2 = ko.observable("");
    this.city = ko.observable("");
    this.state = ko.observable("");
    this.email = ko.observable("");
    this.zip = ko.observable("");
    this.country = ko.observable(["USA", "Canada", "Other"]);
    this.countryValue = ko.observable("");
    this.shipping = [
       "USPS - First Class (USA Only)",
        "USPS - First Class International",
        "USPS - Priority (USA Only)",
        "USPS - Priority International",
        "USPS - Express (USA Only)",
        "USPS - Express International",
        "UPS - Ground (USA Only)",
        "UPS - 2nd Day Air (USA Only)",
        "UPS - Next Day Air (USA Only)"
        ];
    this.shippingValue = ko.observable("");
    this.insured = ["NO", "YES"];
    this.insuredValue = ko.observable("");
    this.giftMessage = "";
    
    
    self.items = ko.observableArray([new itemModel()]);
    
    self.talk = function(i) {console.log(i.firstName())};
    self.addItem = function () { 
            self.items.push(new itemModel(self));
     };
    self.removeItem = function (item) { 
         if(self.items().length > 1){
            self.items.remove(item) 
         }
    };
  
};


function itemModel()
{
    var self = this;
    //this.orderId = ko.observable("");
    self.styles = ko.observable("");
    self.colors = ko.observable("");
    self.sizes = ko.observable("");
    self.designValue = ko.observable("");
    self.styleValue = ko.observable("");
    self.colorValue = ko.observable("");
    self.sizeValue = ko.observable("");
    //console.log(self.itemdesigns());
    self.quantity = "0";
    


     self.designValue.subscribe(function(value){
        if(value)
        {
        
         $.get("./style/index.php",{designid : value.designid, companyid : companyid}, self.styles);
         
         self.styleValue(undefined);
        }
     });

    self.styleValue.subscribe(function (value) {
        if(value)
        {
           
         $.get("./style/colors.php", {styleid : value.styleid}, self.colors);
          $.get("./style/sizes.php", {styleid : value.styleid}, self.sizes);
        self.colorValue(undefined);
        self.sizeValue(undefined);
        }
       
    });
    

    
}

// Activates knockout.js

 



//$.getJSON("http://pokeapi.co/api/v2/pokemon/1", function(data){
//	console.log(data);
//});

Date.prototype.now = function() {
  var yyyy = this.getFullYear().toString();
  var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
  var dd  = this.getDate().toString();
  return yyyy + (mm[1]?mm:"0"+mm[0]) + (dd[1]?dd:"0"+dd[0])
}