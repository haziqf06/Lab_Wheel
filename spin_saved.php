<?php
include "db.php";
include "wheel_lib.php";

$id = intval($_GET["id"]);

$result = mysqli_query($conn, "SELECT * FROM wheels WHERE id = $id");
$row = mysqli_fetch_assoc($result);

if (!$row)
{
    die("Wheel not found. <a href='saved.php'>Back</a>");
}

$items = cleanItems($row["options"]);
$winnerIndex = rand(0, count($items) - 1);
$winner = $items[$winnerIndex];

// remember this spin in the spins table
$w = mysqli_real_escape_string($conn, $winner);
mysqli_query($conn, "INSERT INTO spins (wheel_id, winner) VALUES ($id, '$w')");
?>
<html>
<head>
<title>Spin</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1><?php echo htmlspecialchars($row["title"]); ?></h1>

<?php drawWheel($items, $row["theme"], $winnerIndex, 5); ?>

<p class="winner" style="animation-delay: 5s">
Winner: <?php echo htmlspecialchars($winner); ?>
</p>

<h3>Last 5 winners</h3>
<?php
$log = mysqli_query($conn, "SELECT winner, spun_at FROM spins WHERE wheel_id = $id ORDER BY id DESC LIMIT 5");

echo "<table><tr><th>Winner</th><th>When</th></tr>";
while ($r = mysqli_fetch_assoc($log))
{
    echo "<tr><td>" . htmlspecialchars($r["winner"]) . "</td>"
       . "<td>" . $r["spun_at"] . "</td></tr>";
}
echo "</table>";
?>

<a href="saved.php">Back to saved wheels</a>

</body>
</html>