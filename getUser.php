<?php
include './connection.php';
require_once('./verifyToken.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    verifyToken();
    $userId = $_GET['userId'];

    $query = "SELECT * FROM `users` WHERE `id` = '$userId'";
    $result = mysqli_query($link, $query);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        // !REFINE THIS (DO NOT SEND PASSWORD WITH OTHER DATA)
        echo json_encode($row);
    } else {
        echo json_encode("USER NOT FOUND");
    }
} else {
    echo json_encode("UN_AUTHORIZED");
}