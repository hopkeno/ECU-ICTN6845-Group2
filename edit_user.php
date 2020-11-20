<?php
	require_once('valid_user.php'); 
	require_once("database.php");
    require_once("user_db.php");
    require_once("task_db.php");
    include("header.php");
    // Get the task data from the form
    $vid = filter_input(INPUT_GET, "volunteer_id");
	$vol = get_volunteer($vid);
	if ($vol['is_admin']) { $admin_checkbox = "checked"; }
?>


<fieldset>
	<legend>Edit User</legend>
	<form action="index.php" method="post">			
			<table data-toggle="table">
			<tr>
				<th>Username:</th>
				<td><?php print($vol['username']); ?></td>
			</tr>	
			<tr>
				<th>First Name:</th>
				<td><input type="text" name="firstname" value="<?php print($vol['first_name']); ?>" required></td>
			</tr>
			<tr>
				<th>Last Name:</th>
				<td><input type="text" name="lastname" value="<?php print($vol['last_name']); ?>" required></td>
			</tr>
			<tr>
				<th>Email:</th>
				<td><input type="email" name="email" value="<?php print($vol['email']); ?>" required></td>
			</tr>
			<tr>
				<th><label for="isadmin">Admin:</label></th>
				<td><input type="checkbox" name="isadmin" value="1" <?php print($admin_checkbox); ?>></td>
			</tr>
		</table>
		<input type="hidden" name="volunteer_id" value="<?php print($vol['volunteerID']); ?>">
		<input type="hidden" name="action" value="update_user">
		<input type="submit" class="button" value="Update User">
	</form>
</fieldset>

<?php include("footer.php"); ?>


