<section class="rect multi">
	<form name="newInvitations" method="POST">
		<table>
			<tr>
				<th colspan="2">New Invitations</th>
			</tr>
			<?php 
				$users = showInvitations($db_connection, $_SESSION['user']);
				foreach ($users as $key => $value) {
					echo '<tr><td><label for="'.$value.'">'. $value . '</label></td>
					<td><input type="checkbox" name="accepted[]" id="'.$value.'" value="'.$value.'"/></td></tr>';									
				}
			?>
		</table>
		<input type="submit" name="submitInvitations" value="Accept selected"/>
	</form>
</section>