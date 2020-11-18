<?php
require_once('valid_user.php'); 
require_once("database.php");
require_once("user_db.php");
require_once("task_db.php");
$max_volunteers = 10;	//maximum number of volunteers needed for a task
include("header.php");
?>

	
 	<fieldset>
		<legend>Administrator Info</legend>
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
		<legend>Task Assignments</legend>
		<form action="index.php" method="post">			
			<table>
			<tr>
				<th>Volunteer:</th>
				<th>Task:</th>
				<th>Persons:</th>
				<th>Location:</th>
				<th>Time:</th>
				<th>Scheduled By:</th>
				<th>Task Actions:</th>
			</tr>
			<?php
				$tasks = get_tasks();
				$vols = get_volunteers();
				foreach ($tasks as $task) {
					print("<tr>");
					if ($task["volunteerID"]) {
						// if the task has a volunteer, get the assigner
						$assigner = get_volunteer($task["assignerID"]);
						$aname = $assigner["username"];
					} else {
						$aname = "-";
					}
					//create the dropdown selection for volunteer
					print('<td><select name="assign_volunteer[]" id="assign_volunteer"><br>');
					// always start with a blank option used to unassign a volunteer
					print('<option value="' . $task["taskID"] . ',-"></option>');
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
					print("<td>" . $task["personsNeeded"] . "</td>");
					print("<td>" . $task["location"] . "</td>");
					print("<td>" . $task["scheduledTime"] . "</td>");
					print("<td>" . $aname . "</td>");
					print("<td><a href=\"index.php?action=edit_task&taskid=" . $task['taskID'] . "\">Edit</a><br>");
					print("<a href=\"index.php?action=remove_task&taskid=" . $task['taskID'] . "\">Delete</a></td>");
					print("</tr>");
				}
				?>
			</table>
			<input type="hidden" name="action" value="assign_volunteer">
			<input type="submit" id="button" value="Update Volunteers">
		</form>
	</fieldset>
	<fieldset>
		<legend>Create Task</legend>
		<form action="index.php" method="post">			
				<table>
				<tr>
					<th>Task Name:</th>
					<td><input type="text" name="task_title"></td>
				</tr>	
				<tr>
					<th>Persons Required:</th>
					<td><select name="task_personsNeeded">
					<?php
						for ($i=1; $i <= $max_volunteers ; $i++) { 
							print("<option value=\"$i\">$i</option>");
						}
					?>
					</select></td>
				</tr>
				<tr>
					<th>Scheduled Date:</th>
					<td><input type="date" name="task_scheduledTime" ></td>	
				</tr>
				<tr>
					<th>Location:</th>
					<td><input type="text" name="task_location" ></td>
				</tr>
			</table>
			<input type="hidden" name="action" value="create_task">
			<input type="submit" id="button" value="Create Task">
		</form>
	</fieldset>
	
<?php include("footer.php"); ?>
