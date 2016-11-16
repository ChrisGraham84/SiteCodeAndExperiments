<html>
	<head>
		<title>Deconstruction Development - Login</title>
		<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
	</head>
	<body>
	<script type="text/javascript" language="javascript">
	function validateForm()
	{
		var uname = $("#username").val();
		var password = $("#password").val();
		
		if(uname == null || uname == "")
		{
			alert("User Name Field is Empty");
			return false;
		}
		
		if(password == null || password =="")
		{
			alert("Password Field is Empty");
			return false;
		}
		return true;
	}
	
	</script>
	
		<form name="loginform" action="loginCheck.php" onsubmit="return validateForm();" method="post">
			<table>
				<tr>
					<td>Please Login</td>
				</tr>
				<tr>
					<td>UserName</td>
					<td><input type="text" id="username" name="username"/></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" id="password" name="password"/></td>
				</tr>
				<tr>
					<td><input type="submit" value="Login" /></td>
				</tr>
			</table>
		</form>
	</body>
	
</html>