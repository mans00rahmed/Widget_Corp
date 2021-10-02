<?php require_once("includes/connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
    <tr>
        <td id="navigation">
            <?php echo navigation($sel_subject, $sel_page) ?>

            <br>
            <a href="new_subject.php">+ Add a new subject</a>
        </td>
        <td id="page">
            <h2>
                <?php if (!is_null($sel_subject)) { // subject selected 
                ?>
                    <h2><?php echo $sel_subject['menu_name']; ?></h2>
                <?php } elseif (!is_null($sel_page)) { // page selected 
                ?>
                    <h2><?php echo $sel_page['menu_name']; ?></h2>

                    <div class="page-content">
                        <?php echo $sel_page['content']; ?>
                    </div>

                    <br />
                    <a href="edit_page.php?page=<?php echo urlencode($sel_page['id']); ?>">Edit page</a>
                <?php } else { // nothing selected 
                ?>
                    <h2>Select a subject or page to edit</h2>
                <?php } ?>
            </h2>

        </td>

    </tr>

</table>
</div>

<?php require("includes/footer.php") ?>