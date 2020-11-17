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
	
		<form action="index.php" method="post" id="logout">
			<input type="hidden" name="action" value="logout">
			<input type="submit" name="Logout" id="button" value="Logout">
		</form>
	<fieldset>
			<legend>Available Volunteer Opportunities</legend>
			<table>
				<tr>
 					<th></th>
					<th>Task Title</th>
					<th>Number of People Needed</th>
					<th>Location</th>
					<th>Scheduled Time</th>
				</tr>
				<?php
					$tasks = get_unassigned();
					foreach ($tasks as $task) {
						?>
						<tr>
							<td>
							<form action="index.php" method="post">
								<input type="hidden" name="action" value="assign_volunteer">
								<input type="hidden" name="signup_taskid" value="<?php print($task["taskID"]); ?>">
								<input type="submit" name="signup_button" value="Sign Me Up">
							</form>
							</td>
							<?php
							print("<td>" . $task["title"] . "</td>");
							print("<td>" . $task["personsNeeded"] . "</td>");
							print("<td>" . $task["location"] . "</td>");
							print("<td>" . $task["scheduledTime"] . "</td>");
						print("</tr>");
					}
				?>
			</table>
		</form>
	</fieldset>

	<fieldset>
		<legend>My Signups</legend>
		<table>
			<tr>
				<th></th>
				<th>Task Title</th>
				<th>Number of People Needed</th>
				<th>Location</th>
				<th>Scheduled Time</th>
			</tr>
			<?php
				$tasks = get_tasks($_SESSION['volunteerID']);
				foreach ($tasks as $task) {
					?>
					<tr>
						<td>
						<form action="index.php" method="post">
							<input type="hidden" name="action" value="cancel_signup">
							<input type="hidden" name="cancel_taskid" value="<?php print($task["taskID"]); ?>">
							<input type="submit" name="cancel_button" value="Cancel My Signup">
						</form>
						</td>
						<?php
						print("<td>" . $task["title"] . "</td>");
						print("<td>" . $task["personsNeeded"] . "</td>");
						print("<td>" . $task["location"] . "</td>");
						print("<td>" . $task["scheduledTime"] . "</td>");
					print("</tr>");
				}
			?>
			</table>
	</fieldset>
