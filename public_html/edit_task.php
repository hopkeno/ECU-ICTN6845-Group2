<?php
    require_once("database.php");
    require_once("user_db.php");
    require_once("task_db.php");
    
    // Get the task data from the form
    $tid = filter_input(INPUT_POST, "task_id");
    $task = get_task($tid);
?>

<fieldset>
		<legend>Edit Task</legend>
		<form action="index.php" method="post">			
				<table>
				<tr>
					<th>Task Name:</th>
					<td><input type="text" name="task_title" value="<?php print($task['title']); ?>"</td>
				</tr>	
				<tr>
					<th>Persons Required:</th>
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
					<td><input type="date" name="task_scheduledTime" <?php print($task['scheduledTime']); ?>></td>	
				</tr>
				<tr>
					<th>Location:</th>
					<td><input type="text" name="task_location" <?php print($task['location']); ?>></td>
				</tr>
			</table>
			<input type="hidden" name="action" value="edit_task">
			<input type="submit" id="button" value="Update Task">
		</form>
	</fieldset>

