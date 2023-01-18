<?php
// include './connection.php';
// include './jwt.php';

echo json_encode("hello");

// $testArr = [1,2,3,5];
// $following = implode("', '", $testArr);
// $query= "SELECT * FROM `posts` INNER JOIN post_media ON id=post_media.post_id WHERE `user_id` IN('". $following . "')";
// $result = mysqli_query($link, $query);
// $usersFeed = [];
// while ($row = mysqli_fetch_assoc($result)) {
//     array_push($usersFeed, $row);
// }

// function red ($a, $b) {
//     $found = array_search(array_column($b, 'id'), array_column($a, 'id'));
//     if (!$found) {
//         array_push($a, $b);
//     } else if (gettype($found) == gettype($found) . array_filter(gettype($b), "red")) {
//         # code...
//     } 
// }

// $res = array_reduce($usersFeed, "red");

// print_r($usersFeed);

// echo generateJwt("Hello");