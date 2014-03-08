<section class="rect multi">
	<ul>
		<?php
			$contacts = getUserContacts($db_connection, $_SESSION['user']);
			echo '<span><strong>'.count($contacts).' Contacts</strong></span>';
			foreach ($contacts as $key => $value) {
				echo '<li><a>'.$value['contact_user_name']. '</a></li>';
			}
		?>
	</ul>
</section>

<section class="rect multi">
	<span><strong>Add new contact</strong></span>
	<form method="POST" name="searchUser">
		<input type="text" placeholder="Search by username" name="user"/>
		<input type="submit" value="Find" name="submit"/>
	</form>
</section>