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
    $query= "SELECT posts.id, posts.user_id, `caption`, `location`, `type`, `createdDate`, `media_url`, `orientation` FROM `posts` INNER JOIN post_media ON posts.id=post_media.post_id WHERE posts.user_id IN ('". $following . "');";
    $result = mysqli_query($link, $query);
    $usersFeed = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($usersFeed, [
            'id' => $row['id'],
            'user_id' => $row['user_id'],
            'caption' => $row['caption'],
            'location' => $row['location'],
            'type' => $row['type'],
            'createdDate' => $row['createdDate'],
            'media_url' => unserialize($row['media_url']),
            'orientations' => unserialize($row['orientation'])
            // 'comment' => $row['comments']
            // ! LATER WE WILL INCLUDE THE NUMBER OF COMMENTS ON THE POST AND THE LATEST COMMENT.
        ]);
    }

    echo json_encode($usersFeed);
}