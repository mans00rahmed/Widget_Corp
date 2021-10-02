<?php require_once("includes/connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php
if (intval($_GET['subj']) == 0) {
    redirect_to("content.php");
}
?>
<?php
$id = $_GET['subj'];
if($subject = get_subject_by_id($id)){
$query = "DELETE from subjects WHERE id = {$id} LIMIT 1";

$result = $conn->query($query);
if ($conn->affected_rows == 1) {
    redirect_to("content.php");   
}else{
    echo "<p>Subject deletion failed</p>";
    echo "<p>". $conn->error . "</p>";
    echo "<a href = \"content.php\">Return to Main Page </a>";

}
}else{
    redirect_to("content.php");
}
?>

<?php $conn->close(); ?>
