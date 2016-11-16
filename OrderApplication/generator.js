function companyModel(){
    var self = this;
    this.companyID = "606";
    this.companyName = "Calculated Failure";
    self.product = new productModel();
}

function designModel()
{

}

function productModel(){
    var self = this;
    this.brand = ko.observable("");
    this.styleValue = ko.observable("");
    this.frontDesign = new designModel();
    this.backDesign = new designModel();
    this.colors = ko.observableArray([new colorModel()]);
}

function colorModel(){
    var self = this;
    this.name = "";
    this.rgbValue = "";
}

function swatchChange(swatch){
    //console.log(swatch)
     $("#shirtTemplate").css("background-color", swatch.value);
}

function imagePreview()
{
    var preview = $("#drag-1")[0];
    //console.log(preview);
    var file    = $('input[type=file]')[0].files[0]; 
    //console.log(file);
    var reader = new FileReader();

    reader.addEventListener("load", function () {
        preview.src = reader.result;
        //console.log(preview.width);
      
            preview.width = 200;

    }, false);

    if (file) {
        reader.readAsDataURL(file);
    } 
}
// Activates knockout.js
$(document).ready(function() {
    ko.applyBindings(companyModel());
});