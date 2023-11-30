<?php
include '../config.php';
if (isset($_POST['imie']) && !empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['user_role'])) {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email =  $_POST['email'];
    $rola = $_POST['user_role'];
    $query2 = $link->prepare("SELECT * from users WHERE email=?");
    $query2->bind_param('s', $email);
    $query2->execute();
    $result = $query2->get_result();
    $isThatUserInBase = mysqli_num_rows($result) > 1 ? true : false;
    if ($isThatUserInBase == 1) {
        echo '<script>alert("Użytkownik o takim adresie email istnieje już na naszym portalu")</script>';
        session_destroy();
        header('refresh:0.1; url=../admin.php');
    } else {
        $password = hash('sha256', $_POST['password']);
        $query = $link->prepare("INSERT INTO users VALUES (NULL, ?, ?, ?, ?, ?)");
        $query->bind_param('sssss', $imie, $nazwisko, $email, $password, $rola);
        $query->execute();
        header("Location: ../admin.php");
    }
} else {
    echo '<script>alert("Wszystkie pola muszą być wypełnione")</script>';
    header('refresh:0.1; url=../register.php');
}
