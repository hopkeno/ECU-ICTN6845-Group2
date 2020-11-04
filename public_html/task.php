<?php
require_once('valid_user.php'); 
require_once("database.php");
require_once("user_db.php");
require_once("task_db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Final project</title>   
</head>



<body>
	<header>
		<h1>East Carolina University </h1>
		<h1>Cultural Center</h1>
		<img src=images/worldpeacelogo.jpeg alt="worldpeacelogo" width="150">	
	</header>
	<style>
	header {
	background-image: -webkit-linear-gradient(45deg, white 0%, green 75%, black 110%);
    background-image: -moz-linear-gradient(45deg, white 0%, green 75%, black 110%);
    background-image: -o-linear-gradient(45deg, white 0%, green 75%, black 110%%);
    background-image: linear-gradient(45deg, white 0%, green 75%, black 110%);
	border: 2px solid black;
	text-align: center;
	}
	header img { 
	float:left;
	margin-top:0em;
	margin-bottom:20em;
	} 
	
	fieldset {
    margin: .5em;
    border:1px solid black;
	Font-size: 150%;
	}
	
	legend {
    font-weight: bold;
    font-size: 120%;
	text-align: left;
  }
  
label {     color: blue;
			width: 6em;
			padding-right: 1em;
			position: absolute;
			}

th {	    color: blue;
			width: 6em;
			padding-right: 1em;
			font-weight: normal;
			text-align: left;
}

select {    width: 10em;
			margin-bottom: 1em;
			margin-left:12em;
			font-weight: bold;
		}
		
input {   
           margin-left: 12em;
		   margin-bottom: 1em;
		   font-weight: bold;
		   width: 12em;			   
      }
	  
 #button {
			width: 12em; 
			background-color: rgb(192, 192, 192);
			border: 1px solid black;  
			margin-left: 12em;
			}
 p{
	        color: blue;
			
 }
	</style>
	
	<fieldset>
		<legend>Session Info</legend>
		<table>
			<tr>
				<th>Username:</th>
				<td><?php print($_SESSION['username']); ?></td>
			</tr>
			<tr>
				<th>First Name:</th>
				<td><?php print($_SESSION['first_name']); ?></td>
			</tr>
			<tr>
				<th>Last Name:</th>
				<td><?php print($_SESSION['last_name']); ?></td>
			</tr>
			<tr>
				<th>Email:</th>
				<td><?php print($_SESSION['email']); ?></td>
			</tr>
		</table>
		<form action="index.php" method="post" id="logout">
			<input type="hidden" name="action" value="logout">
			<input type="submit" name="Logout" id="button" value="Logout">
		</form>
	</fieldset>
		 <form action="task.php" method="post">
					
					<fieldset>
					<label>Tasks:</label>
					<legend>Tasks Available</legend>
					<select name="tasks_available" id="tasks_available"><br>
				    	<option value="c">Cleaning</option>
				    	<option value="p">Painting</option>
						<option value="ch">Childcare</option>
						<option value="f">Food distribution</option>
					</select><br>
					
					<label>Date:</label>
					<input type="date" name="starting_date" id="starting_date" ><br>
					
					<label>Time slots:</label>
					<select name="Time_Slots" id="Time_Slot"><br>
				    	<option value="1">9:30am-10:30am</option>
				    	<option value="2">12:30pm-1:30pm</option>
						<option value="ch">5:30pm-6:30pm</option>
					</select><br>
					<label>Locations:</label>
					<select name="Locations" id="Locations"><br>
				    	<option value="d">Durham</option>
				    	<option value="a">Apex</option>
						<option value="ch">Chapel Hill</option>
					</select><br><br>
					
					 <input type="submit" name="action" id="button" value="Submit">
           </fieldset>
            <fieldset>
			
					<p>Volunteers Submission information:</p><br><br>
					<input type="submit" name="action" id="button" value="Change my submission">
			 </fieldset>
