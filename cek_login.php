<?php
include 'koneksi.php';

session_start();

$username = $_POST['user'];
$password = md5($_POST['pass']);

$execute_1 = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");

if ($execute_1) {
    $num_rows = mysqli_num_rows($execute_1);

    if ($num_rows > 0) {
        $assoc_1 = mysqli_fetch_assoc($execute_1);

        if ($username == $assoc_1['username'] && $password == $assoc_1['password']) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;

            if ($assoc_1['level'] == "Admin") {
                header('location: production/index.php');
            } else if ($assoc_1['level'] == "Apoteker") {
                header('location: apoteker/index1.php');
            }
        } else {
            $_SESSION['d'] = true;
            header('location: index.php');
        }
    } else {
        $_SESSION['d'] = true;
        header('location: index.php');
    }
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
