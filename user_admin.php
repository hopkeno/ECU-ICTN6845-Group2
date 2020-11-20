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
				<th>Modify</th>
			</tr>
		</thead>
		<?php
			foreach($users as $user) {
				print("<tr>");
				print("<td>" . $user['username'] . "</tr>");
				print("<td>" . $user['first_name'] . "</tr>");
				print("<td>" . $user['last_name'] . "</tr>");
				print("<td>" . $user['email'] . "</tr>");
				print("<td>");
				if ($user['is_admin']) {
					print('<i class="fa fa-check-circle"></i>');
					print("</td><td>");
				} else {
					print('</td><td>i class="fa fa-check-circle"></i>');
				}
				print("</td>");
				print("<td><a class=\"edit\" href=\"\" title=\"Edit\"><i class=\"fa fa-edit\"></i></a></td>");
				print("<td><a class=\"remove\" href=\"\" title=\"Remove\"><i class=\"fa fa-trash\"></i></a></td>");
				print("</tr>");
		}
		?>
	</table>
</fieldset>	
<?php include("footer.php"); ?>
