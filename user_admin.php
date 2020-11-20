<?php
require_once('valid_user.php'); 
require_once("database.php");
require_once("user_db.php");
include("header.php");
$users = get_volunteers();
?>
	
<fieldset>
	<legend>User Manager</legend>
	<table data-toggle="table">
		<thead>
			<tr class="tr-class-1">
				<th>username</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Admin</th>
				<th>Volunteer</th>
				<th>Edit User</th>
				<th>Delete User</th>
			</tr>
		</thead>
		<?php
			foreach($users as $user) {
				print("<tr>");
				print("<td>" . $user['username'] . "</td>");
				print("<td>" . $user['first_name'] . "</td>");
				print("<td>" . $user['last_name'] . "</td>");
				print("<td>" . $user['email'] . "</td>");
				print("<td>");
				if ($user['is_admin']) {
					print('<i class="fa fa-check-circle"></i>');
					print("</td><td>");
				} else {
					print('</td><td><i class="fa fa-check-circle"></i>');
				}
				print("</td>");
				print("<td><a class=\"edit\" href=\"\" title=\"Edit\"><i class=\"fa fa-edit\"></i></a></td>");
				if ($user['volunteerID'] == $_SESSION['volunteerID']) {
					print("<td><i class=\"fa fa-ban\"></i></td>");
				} else {
					print("<td><a class=\"remove\" href=\"index.php?action=delete_user&volunteer_id=" . $user['volunteerID'] . "\" title=\"Remove\"><i class=\"fa fa-trash\"></i></a></td>");
				}
				print("</tr>");
		}
		?>
	</table>
</fieldset>	

<fieldset>
	<form action="add_user.php" method="post" id="login_form">
		<legend>Add New User</legend>
		<label>First Name:</label>
		<input type="text" name="first_name" required><br><br>
		<label>Last Name:</label>
		<input type="text" name="last_name" required><br><br>
		<label>E-Mail:</label>
		<input type="email" name="email" required><br><br>
		<label>Create Username:</label>
		<input type="text" name="username" required><br><br>
		<label>Create Password:</label>
		<input type="password" name="password" required><br><br>	
		<label>Verify Password:</label>
		<input type="password" name="password2" required><br><br>	  
		<input type="submit"  class="button" value="Register"><br><br>
	</form>
</fieldset>

<?php include("footer.php"); ?>
