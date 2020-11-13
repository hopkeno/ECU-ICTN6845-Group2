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
		label {
		color: blue;
		width: 6em;
		padding-right: 1em;
		position: absolute;
		}
		th  {
		color: blue;
		width: 6em;
		padding-right: 1em;
		text-align: left;
		font-weight: normal;
		}				
		select {
		width: 10em;
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
		p {
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
	<fieldset>
		<form action="index.php" method="post">			
			<legend>Task Assignments</legend>
			<table>
				<tr>
					<th>Volunteer</th>
					<th>Task</th>
					<th>Description</th>
					<th>Persons</th>
					<th>Location</th>
					<th>Time</th>
					<th>Scheduled By</th>
				</tr>
				<?php
				$tasks = get_tasks();
				$vols = get_volunteers();
				foreach ($tasks as $task) {
					print("<tr>");
					if ($task["volunteerID"]) {
						// if the task has a volunteer, get the assigner
						$assigner = get_volunteer($task["assignerID"]);
						$aname = $assigner["last_name"] . ", " . $assigner["first_name"] . " - " . $assigner["email"];
					} else {
						$aname = "-";
					}
					//create the dropdown selection for volunteer
					print('<td><select name="assign_volunteer[]" id="assign_volunteer"><br>');
					// always start with a blank option used to unassign a volunteer
					print('<option value="' . $task["taskID"] . '",-></option>');
					//enumerate the volunteers and build the dropdown
					foreach($vols as $vol) {
						$vname = $vol["last_name"] . ", " . $vol["first_name"] . " - " . $vol["email"];
						if ($vol["volunteerID"] != $task["volunteerID"]) {
							print('<option value="' . $task["taskID"] . "," . $vol["volunteerID"] . '">' . $vname . '</option>');
						} else {
							print('<option value="' . $task["taskID"] . "," . $vol["volunteerID"] . '" selected>' . $vname . '</option>');
						}
					}
					print("</select></td>");
					print("<td>" . $task["title"] . "</td>");
					print("<td>" . $task["description"] . "</td>");
					print("<td>" . $task["personsNeeded"] . "</td>");
					print("<td>" . $task["location"] . "</td>");
					print("<td>" . $task["scheduledTime"] . "</td>");
					print("<td>" . $aname . "</td>");
					print("<td><a href=\"index.php?action=remove_task&taskid=" . $task['taskID'] . "\">Delete Task</a>");
					print("</tr>");
				}
				?>
			</table>
			<input type="hidden" name="action" value="assign_volunteer">
			<input type="submit" id="button" value="Update Tasks">
		</form>
	</fieldset>
	
</body>
</html>
