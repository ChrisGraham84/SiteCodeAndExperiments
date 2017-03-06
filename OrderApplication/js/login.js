$(document).ready(function(){
  $("#add_err").css("display","none","important");
  $("#login").click(function(){
      $("#add_err").css("display","none","important");
     var username = $("#username").val();
     var password = $("#password").val();
     //console.log(username);
     $.ajax({
         type: "POST",
         url: "login.php",
         data: "username=" + username + "&password=" + password,
         success: function(html){
             
             if(html==1)
             {
                 //console.log("loggedin");
                 window.location = "admin.php";
             }
             else
             {
                 console.log(html);
                 $("#add_err").css('display', 'inline', 'important');
			    $("#add_err").html("Wrong username or password");
             }
         }
     });
     return false;
  });
});