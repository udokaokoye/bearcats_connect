<?php
include './connection.php';
require_once('./verifyToken.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    verifyToken();
    $post_id = $_GET['pid'];

    $query = "SELECT `comment`, `reply_id`, `firstName`, `lastName`, `username`, `profile_picture`, `dateCreated`, `post_id`, comments.id AS id FROM comments LEFT JOIN users on comments.user_id=users.id WHERE `post_id`=$post_id ORDER BY comments.id DESC";
    $result = mysqli_query($link, $query);
    $comments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($comments, $row);
    }

    echo json_encode($comments);

} else {
    echo json_encode("UN_AUTHORIZED ACCESS");
}