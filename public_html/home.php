
<head>
    <title>Final project</title>
	<meta charset="utf-8">
    <link rel="stylesheet" href="styles/normalize.css">
	<link rel="stylesheet" href="styles/main.css">
</head>

<body>
	<header>
	<h1>East Carolina University </h1>
	<h1>Cultural Center</h1>
    <img src=images/worldpeacelogo.jpeg alt="worldpeacelogo" width="150">	
	</header>
	
	<h2>Volunteers page</h2>
    <main>
    <p>In order to sign up for tasks, you need to register first.</p>
	<p>Already registered, please click <a href="login.php">here and login</a> to your account.</p>
   
	<form action="add_user.php" method="post" id="login_form">
		<fieldset>
			<legend>Registration</legend>
			<label>First Name:</label>
			<input type="text" name="first_name" value=""><br><br>
			<label>Last Name:</label>
			<input type="text" name="last_name" value=""><br><br>
			<label>E-Mail:</label>
			<input type="text" name="email" value=""><br><br>
			<label>Create Username:</label>
			<input type="text" name="username" value=""><br><br>
			<label>Create Password:</label>
			<input type="password" name="password"  value=""><br><br>	
			<label>Verify Password:</label>
			<input type="password" name="password2"  value=""><br><br>	  
			<input type="submit"  id="button" value="Register"><br><br>
		</fieldset>
	</form>
          
		  

	<style>
	p{
	text-align: centered;	
	}
	
	</style>
	
</main>
	
	</body>


