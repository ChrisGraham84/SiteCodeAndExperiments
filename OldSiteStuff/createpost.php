<html>
    <head>
        <title>Make a Post</title>
    </head>
    <body>
    <script type="text/javascript" language="javascript">
	function validateForm()
	{
		var ptitle = $("#posttitle").val();
		var pbody = $("#postbody").val();
		
		if(ptitle == null || ptitle == "")
		{
			alert("Post Needs a Title");
			return false;
		}
		
		if(pbody == null || pbody =="")
		{
			alert("Post Needs A Body");
			return false;
		}
		return true;
	}
	
	</script>
    <form name="postform" action="makepost.php" onsubmit="return validateForm();" method="post">
    <?php
   if($_COOKIE["userid"] == 2){ ?>
       <table>
        <tr>
            <td>Post Title</td><td><input id="posttitle" name="posttitle" type="text"></td>
        </tr>
        <tr>
            <td>Post Body</td><td><textarea col="100" id="postbody" name="postbody" row="600"></textarea> </td>
        </tr>
        <tr>
            <td><input type="submit" value="Post!" title="Post!"></td>
        </tr>
       </table>
    <?php }
   else
   { echo "Sorry You Need to be Logged In to Post";}
       ?>
    <p>
     <a href="index.php">Go To Home Page</a>   
        
    </p>
    </form>
    </body>
</html>