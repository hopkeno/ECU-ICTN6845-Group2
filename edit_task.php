<?php
	require_once('valid_user.php'); 
	require_once("database.php");
    require_once("user_db.php");
    require_once("task_db.php");
    include("header.php");
    // Get the task data from the form
    $tid = filter_input(INPUT_GET, "taskid");
	$task = get_task($tid);
	$max_volunteers = 10;	//maximum number of volunteers needed for a task
?>


<fieldset>
		<legend>Edit Task</legend>
		<form action="index.php" method="post">			
				<table>
				<tr>
					<th>Task Name:</th>
					<td><input type="text" name="task_title" value="<?php print($task['title']); ?>" required></td>
				</tr>	
				<tr>
					<th>Number of People Required:</th>
					<td><select name="task_personsNeeded">
					<?php
						for ($i=1; $i <= 10 ; $i++) { 
                            if ($task["personsNeeded"] == $i) {
                                print("<option value=\"$i\" selected>$i</option>");
                            } else {
                                print("<option value=\"$i\">$i</option>");
                            }
						}
					?>
					</select></td>
				</tr>
				<tr>
					<th>Scheduled Date:</th>
					<td><input type="datetime-local" name="task_scheduledTime" value="<?php print(str_replace(" ","T",$task['scheduledTime']));?>" required></td>	
				</tr>
				<tr>
					<th>Location:</th>
					<td><input type="text" name="task_location" value="<?php print($task['location']); ?>" required></td>
				</tr>
			</table>
			<input type="hidden" name="task_id" value="<?php print($tid); ?>">
			<input type="hidden" name="action" value="update_task">
			<input type="submit" class="button" value="Update Task">
		</form>
	</fieldset>

<?php include("footer.php"); ?>


