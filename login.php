<?Php
include './connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email= $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT `password` FROM users WHERE `email` = '$email' ";
    $result = mysqli_query($link, $query);
            if ($result->num_rows > 0) {
                $hashpassword = mysqli_fetch_assoc($result)['password'];
                if (password_verify($password, $hashpassword)) {
                    echo json_encode(true);
                } else {
                    echo json_encode(false);
                }
            } else {
                echo json_encode('NO-USER');
            }
} else {
    echo json_encode("UN-AUTHORIZED");
}

