<?php
include './connection.php';
require_once('./verifyToken.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    verifyToken();
    
    $userId = $_GET['userId'];
    $followedUserId = $_GET['followedUserId'];

    if (isset($_GET['unfollow'])) {
        $query = "DELETE FROM followers WHERE `following_user_id`='$userId' AND `followed_user_id`='$followedUserId'";
    
        if (mysqli_query($link, $query)) {
            echo json_encode("SUCCESS");
        } else {
            echo json_encode("Failed");
        }
    }

    if (isset($_GET['follow'])) {
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

    // ! CHECK IF FOLLOW EXISTS ALREADY!!!!!!!

}
