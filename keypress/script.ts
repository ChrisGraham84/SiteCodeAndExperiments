//activeObject
class activeObject {
    el: HTMLElement;
    x: number;
    y: number;

    consstructor(){
        
    }
    assignElement(element: HTMLElement){
        for (var i = 0; i < objs.length; i++) {
            var e = objs[i] as HTMLElement;
            e.style.border = "none";
        }
        this.el = element;
        this.x = parseInt(this.el.style.left,10);
        this.y = parseInt(this.el.style.top, 10);
        this.el.style.border = "1px solid black";
        this.displayInfo();
    }
    displayInfo(){
        var info = document.getElementById("carInfo");
        info.innerText = "Color: " + this.el.style.backgroundColor + " - Position: ( " + this.x + " , " + this.y + " )";
    }

}

var car = new activeObject();

var objs = document.getElementsByClassName("GmObj");
for (var i = 0; i < objs.length; i++) {
        objs[i].addEventListener("click", function() {
            car.assignElement(this);
        });
}

var speed = 10;
function keyboardInput(event: KeyboardEvent) {
   if(car.el != undefined){
        // left arrow
        if(event.keyCode === 37) {
            car.x -= speed;
            car.el.style.left = car.x.toString() + "px";
            car.displayInfo();
        }
        // up arrow
        if(event.keyCode === 38) {
            car.y -= speed;
            car.el.style.top = car.y.toString() + "px";
            car.displayInfo();
        }
        // right arrow
        if(event.keyCode === 39) {
            car.x += speed;
            car.el.style.left = car.x.toString() + "px";
            car.displayInfo();
        }
        // down arrow
        if(event.keyCode === 40) {
            car.y += speed;
            car.el.style.top = car.y.toString() + "px";
            car.displayInfo();
        }
        // space button
        if(event.keyCode === 32 ) {
         
        }
    }
}

var tstartx = 0;
var tstarty = 0;
var tendx = 0;
var tendy = 0;
function touchStart(event: TouchEvent){
    tstartx = event.changedTouches[0].screenX;
    tstarty = event.changedTouches[0].screenY;
}
function touchEnd(event: TouchEvent){
    tendx = event.changedTouches[0].screenX;
    tendy = event.changedTouches[0].screenY;
    handleGesture();
}
function handleGesture(){
    var swiped = 'swiped';
    console.log("tsx " + tstartx);
    console.log("tex " + tendx);
    console.log("tsy " + tstarty);
    console.log("tey" + tendy);
    if(car.el != undefined){
        console.log(swiped);
        if(tendx < tstartx){
            //left
            car.x -= speed;
            car.el.style.left = car.x.toString() + "px";
            car.displayInfo();
        }
        if(tendx > tstartx){
            //right
            car.x += speed;
            car.el.style.left = car.x.toString() + "px";
            car.displayInfo();
        }
        if(tendy > tstarty){
            //down
            car.y += speed;
            car.el.style.top = car.y.toString() + "px";
            car.displayInfo();
        }
        if(tendy < tstarty){
            //up
            car.y -= speed;
            car.el.style.top = car.y.toString() + "px";
            car.displayInfo();
        }
    }
    if(tstartx == tstarty){
        //touch
        car.assignElement(this);
    }

}

document.addEventListener("touchstart", touchStart)
document.addEventListener("touchend", touchEnd)
document.addEventListener("keydown", keyboardInput);

