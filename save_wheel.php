<?php
include "db.php";

// escape the text so quotes such as O'Brien cannot break the SQL
$t = mysqli_real_escape_string($conn, $title);
$o = mysqli_real_escape_string($conn, $_POST["options"]);

$sql = "INSERT INTO wheels (title, theme, options) VALUES ('$t', '$theme', '$o')";

if (mysqli_query($conn, $sql))
{
    $saveMessage = "Wheel saved. <a href='saved.php'>See saved wheels</a>";
}
else
{
    $saveMessage = "Could not save: " . mysqli_error($conn);
}
?>