<?php
include './connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $userId = $_POST['userId'];
    $followedUserId = $_POST['followedUserId'];

    $query = "INSERT INTO `followers` (`following_user_id`, `followed_user_id`) VALUES (
        '".mysqli_real_escape_string( $link, $userId )."', 
        '".mysqli_real_escape_string( $link, $followedUserId )."'
    )";

    if (mysqli_query($link, $query)) {
        echo json_encode("SUCCESS");
    } else {
        echo json_encode("Failed");
    }
}
