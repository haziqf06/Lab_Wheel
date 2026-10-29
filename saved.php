<?php include "db.php"; ?>
<html>
<head>
<title>Saved Wheels</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Saved Wheels</h1>

<?php
$result = mysqli_query($conn, "SELECT * FROM wheels");

echo "<table>";
echo "<tr><th>ID</th><th>Title</th><th>Theme</th><th>Options</th><th>Action</th></tr>";

while ($row = mysqli_fetch_assoc($result))
{
    $count = count(explode("\n", $row["options"]));
    
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
    echo "<td>" . $row["theme"] . "</td>";
    echo "<td>" . $count . "</td>";
    echo "<td><a href='spin_saved.php?id=" . $row["id"] . "'>Spin</a> | <a href='delete_wheel.php?id=" . $row["id"] . "'>Delete</a></td>";
    echo "</tr>";
}

echo "</table>";
?>

<a href="create.html">Make a new wheel</a>

</body>
</html>