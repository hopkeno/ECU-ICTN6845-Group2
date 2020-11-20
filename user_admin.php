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
<?php include("footer.php"); ?>
