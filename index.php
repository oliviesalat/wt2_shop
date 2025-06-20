<?php
include_once("index_header.php");
$db = Database::db_connect();
?>

<body>
<?php
echo "<p>Today: " . date('d.m.Y') . "</p>";


$result = $db->query("SELECT * FROM `test`");

?>


<?php
include_once("index_footer.php");
?>