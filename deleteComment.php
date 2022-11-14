<?php
include './connection.php';
// require_once('./verifyToken.php');

$id = $_GET['id'];
// verifyToken();

$query = "DELETE FROM `comments` WHERE `id` = '$id' OR `reply_id` = '$id' ";

if (mysqli_query($link, $query)) {
    echo json_encode('SUCCESS');
} else {
    echo json_encode("FAILED");
}


?>