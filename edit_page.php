<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
// make sure the subject id sent is an integer
if (intval($_GET['page']) == 0) {
	redirect_to('content.php');
}

include_once("includes/form_functions.php");

// START FORM PROCESSING
// only execute the form processing if the form has been submitted
if (isset($_POST['submit'])) {
	// initialize an array to hold our errors
	$errors = array();

	// perform validations on the form data
	$required_fields = array('menu_name', 'position', 'visible', 'content');
	$errors = array_merge($errors, check_required_fields($required_fields));

	$fields_with_lengths = array('menu_name' => 30);
	$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths));

	// clean up the form data before putting it in the database
	$id = $_GET['page'];
	$menu_name = trim($_POST['menu_name']);
	$position = $_POST['position'];
	$visible = $_POST['visible'];
	$content = $_POST['content'];

	// Database submission only proceeds if there were NO errors.
	if (empty($errors)) {
		$query = 	"UPDATE pages SET 
							menu_name = '{$menu_name}',
							position = {$position}, 
							visible = {$visible},
							content = '{$content}'
						WHERE id = {$id}";
		$result = $conn->query($query);
		// test to see if the update occurred
		if ($conn->affected_rows == 1) {
			// Success!
			$message = "The page was successfully updated.";
		} else {
			$message = "The page could not be updated.";
			$message .= "<br />" . $conn->error;
		}
	} else {
		if (count($errors) == 1) {
			$message = "There was 1 error in the form.";
		} else {
			$message = "There were " . count($errors) . " errors in the form.";
		}
	}
	// END FORM PROCESSING
}
?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<?php echo navigation($sel_subject, $sel_page); ?>
			<br />
			<a href="new_subject.php">+ Add a new subject</a>
		</td>
		<td id="page">
			<h2>Edit page: <?php echo $sel_page['menu_name']; ?></h2>
			<?php if (!empty($message)) {
				echo "<p class=\"message\">" . $message . "</p>";
			} ?>
			<?php if (!empty($errors)) {
				display_errors($errors);
			} ?>

			<form action="edit_page.php?page=<?php echo $sel_page['id']; ?>" method="post">
				<?php include "page_form.php" ?>
				<input type="submit" name="submit" value="Update Page" />&nbsp;&nbsp;
				<a href="delete_page.php?page=<?php echo $sel_page['id']; ?>" onclick="return confirm('Are you sure you want to delete this page?');">Delete page</a>
			</form>
			<br />
			<a href="content.php?page=<?php echo $sel_page['id']; ?>">Cancel</a><br />
		</td>
	</tr>
</table>

<?php include("includes/footer.php"); ?>