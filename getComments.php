<?php
include './connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];

    $query = "SELECT `user_id`, `post_id`, `comment`, `reply_id`, `dateCreated`, `firstName`, `lastName`, `username`, `profile_picture`, `major` FROM `comments` INNER JOIN `users` ON user_id=users.id WHERE `post_id`='$post_id'";
    $result = mysqli_query($link, $query);
    $comments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($comments, $row);
    }

    echo json_encode($comments);

} else {
    echo json_encode("UN_AUTHORIZED ACCESS");
}