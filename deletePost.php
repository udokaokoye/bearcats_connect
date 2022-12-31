<?php
include './connection.php';
require_once('./verifyToken.php');
verifyToken();


$pid = $_GET['pid'];

$query = "SELECT `media_url` FROM post_media WHERE post_id='$pid'";
$mediFiles = mysqli_fetch_assoc(mysqli_query($link, $query));


if ($mediFiles) {
    foreach (unserialize($mediFiles['media_url']) as $file) {

        if (file_exists('./Images/' . str_replace('http://192.168.1.51/bearcats_connect/Images/', '', $file))) {
            unlink('./Images/' . str_replace('http://192.168.1.51/bearcats_connect/Images/', '', $file));
        }
    }
}


$query = "DELETE FROM post_media WHERE `post_id`='$pid'";

    if (mysqli_query($link, $query)) {
        $query= "DELETE FROM posts WHERE id='$pid'";

        if (mysqli_query($link, $query)) {
            $query = "DELETE FROM comments WHERE `post_id`='$pid'";
            if (mysqli_query($link, $query)) {

                $query = "DELETE FROM postTags WHERE `post_id`='$pid'";
            if (mysqli_query($link, $query)) {
            echo json_encode('SUCCESS');
            }
            }
        } else {
            echo json_encode('FAILED');
        }
    }

