<?php
require_once('valid_user.php'); 
require_once("database.php");
require_once("user_db.php");
require_once("task_db.php");
include("header.php");
?>

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
