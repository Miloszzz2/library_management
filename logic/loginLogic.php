<?php
session_start();
include '../config.php';
if (isset($_POST['email']) && !empty($_POST['email']) && !empty($_POST['password'])) {

    $email =  $_POST['email'];
    $password = hash('sha256', $_POST['password']);
    $query = $link->prepare("SELECT * FROM users WHERE email=? and haslo=?");
    $query->bind_param('ss', $email, $password);
    $query->execute();
    $result = $query->get_result();
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['user'] = $email . ' ' . $password;
        while ($row = $result->fetch_assoc()) {
            $_SESSION['userrole'] = $row['rola'];
        }
        if ($_SESSION['userrole'] === 'administrator') {
            echo "Przenosiny do panelu administratora za 3s";
            header('refresh:3; url=../admin.php');
        } else {
            header("Location: ../index.php");
        }
    } else {
        echo '<script>alert("Nie znaleziono takiego użytkownika")</script>';
        session_destroy();
        header('refresh:0.1; url=../login.php');
    }
} else {
    echo '<script>alert("Wszystkie pola muszą być wypełnione")</script>';
    header('refresh:0.1; url=../login.php');
}
