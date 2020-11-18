<?php
	require_once('valid_user.php'); 
	require_once("database.php");
    require_once("user_db.php");
    require_once("task_db.php");
    
    // Get the task data from the form
    $tid = filter_input(INPUT_GET, "taskid");
	$task = get_task($tid);
	$max_volunteers = 10;	//maximum number of volunteers needed for a task
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
		<legend>Edit Task</legend>
		<form action="index.php" method="post">			
				<table>
				<tr>
					<th>Task Name:</th>
					<td><input type="text" name="task_title" value="<?php print($task['title']); ?>"></td>
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
					<td><input type="date" name="task_scheduledTime" value="<?php print($task['scheduledTime']); ?>"></td>	
				</tr>
				<tr>
					<th>Location:</th>
					<td><input type="text" name="task_location" value="<?php print($task['location']); ?>"></td>
				</tr>
			</table>
			<input type="hidden" name="task_id" value="<?php print($tid); ?>">
			<input type="hidden" name="action" value="update_task">
			<input type="submit" id="button" value="Update Task">
		</form>
	</fieldset>
</body>
</html>


