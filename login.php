<?php 
    include("header.php");
?>
<main>
    
   <form action="index.php" method="post" id="login_form"> 
        <fieldset>
            <legend>Login</legend>
            <label>Username:</label>
            <input type="text" name="username"  value=""><br><br>                
            <label>Password:</label>
            <input type="password" name="password" value=""><br><br>	
            <input type="submit" id="button" value="Login"><br><br>  
        </fieldset>
    </form>
</main>
<?php include("footer.php"); ?>
