<?php

$conn = mysqli_connect("localhost", "root", "sun0896180");
mysqli_select_db($conn, "opentutorials2");
$sql = "INSERT INTO user (author,description) VALUES('".$_POST['author']."','".$_POST['description']."')";
$result = mysqli_query($conn, $sql);
header('Location: http://localhost/rolling/sunset.php'); //sunset.php로 돌아감

 ?>
