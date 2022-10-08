<?php
include './connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];
    $query = "SELECT `followed_user_id` FROM `followers` WHERE `following_user_id` = '$userId'";
    $data = [];
    $result = mysqli_query($link, $query) ;
    
    while ($row = mysqli_fetch_assoc($result)) {
        foreach($row as $key => $value)
    {
        
        array_push($data, $value);
    }
    }

    // echo json_encode($data);
    
    $following = implode("', '", $data);
    // $query = "SELECT * FROM `posts` INNER JOIN users  users.id IN ('". $following . "')";
    // $query = "SELECT * FROM `posts` WHERE `user_id` IN ('". $following . "')";

    // $result = mysqli_query($link, $query);
    // $row = mysqli_fetch_assoc($result);

    // !To GET EVERYTING WITH THE MEDIA 
    $query= "SELECT * FROM `posts` INNER JOIN post_media ON id=post_media.post_id WHERE `user_id` IN ('". $following . "');";
    $result = mysqli_query($link, $query);
    $usersFeed = [];
    while ($row = mysqli_fetch_object($result)) {
        array_push($usersFeed, $row);
    }
    $userfeed2 = $usersFeed;

    echo json_encode(array_unique(array_merge($usersFeed, $userfeed2), SORT_REGULAR));
}