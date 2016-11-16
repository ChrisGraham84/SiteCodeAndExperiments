<? ob_start(); ?>
<html>
<head>
	<title>Deconstruction Developments - Login</title>
</head>
	
	<body>
		<?php
		//user name
		$user = $_POST[username];
		//user password
		$password = $_POST[password];
		
		if(!(strlen($user) == 0) && !(strlen($password)== 0))
		{
			//establish connection
			$con = mysql_connect("localhost","chrisush_dev","ph@the@d");
			if(!$con)
			{
				die('Could Not Connect:' . mysql_error());
			}
			
			//connect to database
			$db_selected = mysql_select_db("chrisush_content",$con);
			if(!$db_selected)
			{
				echo "No DB Found.";
			}
		
			//select user by username/password
			$sql = "SELECT `Name`,`ID` FROM `User` WHERE `Name` = '". $user ."' AND `Password` = '". $password . "' AND `IsActive`= 1";
			
			$result = mysql_query($sql);
			
			
			if(!$result || mysql_num_rows($result) <= 0)
			{
			      echo "Unable to Login,  would you like to <a href='createuser.html'>Create A New User</a>?";
			}
			else
			{
				$name = '';
				$userid = '';
				$expire = time()+60*60*24;
				while($row = mysql_fetch_array($result))
				{
					$name = $row["Name"];
					$userid = $row["ID"];
				}
				
				//add cookie to browser
				setcookie("user",$name,$expire);
				setcookie("userid",$userid,$expire);
				//redirect to home page
				 mysql_close($con);
				header("Location: index.php");
				
			}
			
			
		}
		else
		{
			 mysql_close($con);
			echo "An Error Has Occured.";
		}
		?>
	</body>

</html>
<? ob_flush(); ?>