<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
<h1 style="text-align: center; margin:auto; color:white;padding-top:1%;height:4%; background-color:maroon;">User End</h1>
<table id="structure">
	<tr>
		<td id="navigation">
			<?php echo public_navigation($sel_subject, $sel_page); ?>
		</td>
		<td id="page">
			<?php if ($sel_page) { ?>
				<h2><?php echo htmlentities($sel_page['menu_name']); ?></h2>
				<div class="page-content">
					<?php echo strip_tags(nl2br($sel_page['content']), "<b><br><p><a>"); ?>
				</div>
			<?php } else { ?>
				<h2>Welcome to Widget Corp</h2>
			<?php } ?>
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>