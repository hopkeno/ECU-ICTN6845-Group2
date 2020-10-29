
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
    <form action="succes.php" method="post" >
	
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
		<input type="text" name="password"  value=""><br><br>	
			   
		<label>Verify Password:</label>
		<input type="text" name="password"  value=""><br><br>	  
		   
		
        <input type="submit" name="action" id="button" value="Register"><br><br>
		
    </fieldset>
  
  <form action="tasks.php" method="post" >
   <fieldset>
        <legend>Login</legend>
        
        <label>Username:</label>
		<input type="text" name="username"  value=""><br><br>
			   
			   
        <label>Password:</label>
		<input type="text" name="password" value=""><br><br>	
      
	    <input type="submit" name="Login" id="button" value="Login"><br><br>  
    </fieldset>
	
</main>
	
	</body>


