<?php
include './connection.php';
require_once('./verifyToken.php');
verifyToken();
$uid = $_GET['uid'];
$followers= [];
$following = [];

$query = "SELECT * FROM followers WHERE `followed_user_id`='$uid'";
// ! make sure to make a seprate variable for relsult!!!!!!!!!!!!!!!!!!!!!!
while ($row = mysqli_fetch_assoc(mysqli_query($link, $query))) {
    // array_push($followers, $row)
}




?>