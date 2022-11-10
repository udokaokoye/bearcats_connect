<?php
include './connection.php';
require_once('./verifyToken.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    verifyToken();

    // !To GET EVERYTING WITH THE MEDIA 
        if (isset($_GET['portion']) && $_GET['portion'] == 'following') {
            $userId = $_GET['userId'];
            $query = "SELECT `followed_user_id` FROM `followers` WHERE `following_user_id` = '$userId'";
            $data = [];
            $result = mysqli_query($link, $query) ;
            
            while ($row = mysqli_fetch_assoc($result)) {
                foreach($row as $key => $value)
            {
                
                array_push($data, $value);
            }
            }
            $following = implode("', '", $data);

            $query= "SELECT posts.id, posts.user_id, users.firstName, users.lastName, users.profile_picture, users.username, `caption`, `location`, `type`, `createdDate`, `media_url`, `orientation` FROM `posts` LEFT JOIN post_media ON posts.id=post_media.post_id LEFT JOIN users ON posts.user_id=users.id WHERE posts.user_id IN ('". $following . "') ORDER BY posts.id DESC";
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
                    'images' => unserialize($row['media_url']),
                    'orientation' => unserialize($row['orientation']),
                    'fName' => $row['firstName'],
                    'lName' => $row['lastName'],
                    'profile_picture' => $row['profile_picture'],
                    'username' => $row['username']
                    // 'comment' => $row['comments']
                    // ! LATER WE WILL INCLUDE THE NUMBER OF COMMENTS ON THE POST AND THE LATEST COMMENT.
                ]);
            }
        
            echo json_encode($usersFeed);
        } else {
            $query= "SELECT posts.id, posts.user_id, users.firstName, users.lastName, users.profile_picture, users.username, `caption`, `location`, `type`, `createdDate`, `media_url`, `orientation` FROM `posts` LEFT JOIN post_media ON posts.id=post_media.post_id LEFT JOIN users ON posts.user_id=users.id ORDER BY posts.id DESC";
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
                    'images' => unserialize($row['media_url']),
                    'orientation' => unserialize($row['orientation']),
                    'fName' => $row['firstName'],
                    'lName' => $row['lastName'],
                    'profile_picture' => $row['profile_picture'],
                    'username' => $row['username'],
                    // 'comment' => $row['comment']
                    // ! LATER WE WILL INCLUDE THE NUMBER OF COMMENTS ON THE POST AND THE LATEST COMMENT.
                ]);
            }

            foreach ($usersFeed as $key => $value) {
                $postId = $value['id'];
                $query = "SELECT * FROM comments LEFT JOIN users on comments.user_id=users.id WHERE `post_id`=$postId";
                $result = mysqli_query($link, $query);
                $comments = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($comments, [

                        'comment' => $row['comment'],
                        'reply_id' => $row['reply_id'],
                        'firstName' => $row['firstName'],
                        'lastName' => $row['lastName'],
                        'username' => $row['username'],
                        'date' => $row['dateCreated'],
                        
                        ]);
                }

                if (count($comments)  > 0) {
                    $index = array_search($postId, $usersFeed);
                    $usersFeed[$index] = [
                        $usersFeed[$index],
                        'comment' => $comments
                    ];
                    echo json_encode( $index);
                }

            }

            // ! SELECT ONLY THE IDs THEN DO A FOR EACH LOOP THROUGH ALL THE IDs AND RUN A QUERY LIKE THE ONE IN GET POST

            // $query = "SELECT * FROM comments LEFT JOIN users on comments.user_id=users.id WHERE `post_id`=$postId";
            // $result = mysqli_query($link, $query);
            // $comments = [];
            // while ($row = mysqli_fetch_assoc($result)) {
            //     array_push($comments, [

            //         'comment' => $row['comment'],
            //         'reply_id' => $row['reply_id'],
            //         'firstName' => $row['firstName'],
            //         'lastName' => $row['lastName'],
            //         'username' => $row['username'],
            //         'date' => $row['dateCreated'],
                    
            //         ]);
            // }

            // $query = "SELECT 'firstName', 'lastName', 'username' FROM reactions LEFT JOIN users on reactions.user_id=users.id WHERE `post_id`=$postId";
            // $result = mysqli_query($link, $query);
            // $reactions = [];
            // while ($row = mysqli_fetch_assoc($result)) {
            //     array_push($reactions, [
            //         'firstName' => $row['firstName'],
            //         'lastName' => $row['lastName'],
            //         'username' => $row['username'],
            //         ]);
            // }
        
            // echo json_encode($usersFeed[8]);
        }
} else {
    
}