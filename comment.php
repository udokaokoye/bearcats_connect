<?php
include './connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment = $_POST['comment'];
    $user_id = $_POST['user_id'];
    $post_id =$_POST['post_id'];
    $reply_id = $_POST['reply_id'];

    $query = "INSERT INTO `comments` (`user_id`, `post_id`, `comment`, `reply_id`) VALUES (
        '".mysqli_real_escape_string( $link, $user_id )."', 
        '".mysqli_real_escape_string( $link, $post_id )."', 
        '".mysqli_real_escape_string( $link, $comment )."', 
        '".mysqli_real_escape_string( $link, $reply_id )."'
        )";

        if (mysqli_query($link, $query)) {
            echo json_encode("SUCCESS");
        } else {
            echo json_encode("Failed");
        }
} else {
    echo json_encode("UN_AUTHORIZED ACCESS");
}