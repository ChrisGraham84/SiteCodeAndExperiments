function orderModel() {
    var self = this;
    //this.orderId = ko.observable("");
    //this.designOptions = ["X11", "X12", "X13"];
    //this.designValue = ko.observable("");
    //this.styleOptions = ["G200", "G200L", "G500"];
    //this.styleValue = ko.observable("");
    //this.colorOptions = ["Red", "Blue", "Yellow"];
    //this.colorValue = ko.observable("");
    //this.quantity = "0";
    this.firstName = ko.observable(" ");
    this.lastName = ko.observable(" ");
    this.address1 = ko.observable(" ");
    this.address2 = ko.observable(" ");
    this.city = ko.observable(" ");
    this.state = ko.observable(" ");
    this.email = ko.observable(" ");
    this.country = ko.observable(["USA", "Canada", "Other"]);
    this.countryValue = ko.observable("");
    this.shipping = ["USPS First Class (USA Only)", "USPS International First Class"];
    this.shippingValue = ko.observable("");
    this.insured = ["Yes", "No"];
    this.insured = ko.observable("");
    this.giftMessage = "";

    self.items = ko.observableArray([new itemModel()]);
    
    //self.styleValue.subscribe(function () {
    //    self.colorValue(undefined);
   //});
    self.talk = function(i) {console.log(i.firstName())};
    self.addItem = function () { self.items.push(new itemModel()) };
    self.removeItem = function (item) { self.items.remove(item) };
};

function templateModel()
{

}


function companyModel() {
    var self = this;
    this.companyID = "606";
    this.companyName = "Calculated Failure"
    self.orders = ko.observableArray([new orderModel()]);
    self.choseOrder = ko.observable();
    
    
    //methods
    self.addOrder = function () { 
        var order = new orderModel();
        self.orders.push(order);
        self.choseOrder(order);
    }
    self.removeOrder = function (order) { self.orders.remove(order) };
    self.goToOrder = function(order) {
       //onsole.log(self.orders()[arrayIndx]);
        self.choseOrder(order);
    }
    //console.log(self.orders()[0]);
    self.goToOrder(self.orders()[0]);
};

function itemModel()
{
     var self = this;
    this.orderId = ko.observable("");
    //this.designOptions = ["X11", "X12", "X13"];
    this.designValue = ko.observable("");
    //this.styleOptions = ["G200", "G200L", "G500"];
    this.styleValue = ko.observable("");
    //this.colorOptions = ["Red", "Blue", "Yellow"];
    this.colorValue = ko.observable("");
    this.sizevalue = ko.observable("");
    this.quantity = "0";

    self.styleValue.subscribe(function () {
        self.colorValue(undefined);
    });

    
}

// Activates knockout.js
$(document).ready(function() {
    ko.applyBindings(companyModel());
});

$.getJSON("http://pokeapi.co/api/v2/pokemon/1", function(data){
	//alert(data.name);
});