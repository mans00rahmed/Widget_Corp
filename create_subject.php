<?php require_once("includes/connection.php") ?>
<?php require_once("includes/functions.php") ?>

<?php

$errors = array();
// Form Vlaidation
$required_fields = array('menu_name' , 'position', 'visible');
foreach($required_fields as $fieldname){
    if (!isset($_POST['menu_name']) || empty($_POST['menu_name'])) {
        $errors[] = 'menu_name';
    }
}
 
if (!empty($errors)) {
    redirect_to("new_subject.php");
}
?>

<?php

$menu_name = $_POST["menu_name"];
$position = $_POST["position"];
$visible = $_POST["visible"];

?>

<?php
$query = "INSERT INTO subjects(
            menu_name, position, visible
            ) VALUES( 
                '{$menu_name}', {$position} , {$visible}
            )";

if ($conn->query($query)) {
    //Success
    header("Location: content.php");
    exit;
} else {
    //Display Error Mesage
    echo "<p>Subject Creation failed</p>";
    echo "<p>" . $conn->connect_error . "</p>";
}
?>

<?php $conn->close(); ?>
