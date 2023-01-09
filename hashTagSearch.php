<?php
include './connection.php';

$phrase = $_GET['phrase'];

if ($phrase == '') {
    echo json_encode([]);
    return;
}

$query = "SELECT * FROM hashtags WHERE (`tag` LIKE '%".$phrase."%')";

$result = mysqli_query($link, $query);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    array_push($data, $row);
}

echo json_encode($data);