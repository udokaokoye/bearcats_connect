<?Php
include './connection.php';
include './jwt.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emailUser = $_POST['user'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE `email` = '$emailUser' ";
    if (isset($_GET['withUsername'])) {
        $query = "SELECT * FROM users WHERE `username` = '$emailUser' ";
    }



    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    if ($result->num_rows > 0) {
        $hashpassword = $row['password'];
        if (password_verify($password, $hashpassword)) {
            $token =   generateJwt(
                [
                    'userId' => $row['id'],
                    'fName' => $row['firstName'],
                    'lName' => $row['lastName'],
                    'img' => $row['profile_picture'],
                    'username' => $row['username'],
                    'major' => $row['major']
                ]
            );

            echo json_encode(["SUCCESS", $row['id'], $token]);
        } else {
            echo json_encode("wrong");
        }
    } else {
        echo json_encode('wrong');
    }
} else {
    echo json_encode("UN-AUTHORIZED");
}
