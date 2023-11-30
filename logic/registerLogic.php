<?php
session_start();
include '../config.php';
if (isset($_POST['imie']) && !empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    if (isset($_POST['agreement'])) {
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $email =  $_POST['email'];
        $password = hash('sha256', $_POST['password']);
        $currentDate = new DateTime();
        $currentDate->modify('+30 days');
        $futureDate = $currentDate->format('Y-m-d');
        $query2 = $link->prepare("SELECT * from users WHERE email=?");
        $query2->bind_param('s', $email);
        $query2->execute();
        $result = $query2->get_result();
        $isThatUserInBase = mysqli_num_rows($result) >= 1 ? true : false;
        if ($isThatUserInBase >= 1) {
            echo '<script>alert("Użytkownik o takim adresie email istnieje już na naszym portalu")</script>';
            session_destroy();
            header('refresh:0.1; url=../register.php');
        } else {

            $query = $link->prepare("INSERT INTO users VALUES (NULL, ?, ?, ?, ?, 'uzytkownik', ?)");
            $query->bind_param('sssss', $imie, $nazwisko, $email, $password, $futureDate);
            $query->execute();

            $_SESSION['user'] = $email . ' ' . $password;
            $_SESSION['userrole'] = 'uzytkownik';
            header("Location: ../index.php");
        }
    } else {
        echo '<script>alert("Zaakceptuj regulamin")</script>';
        header('refresh:0.1; url=../register.php');
    }
} else {
    echo '<script>alert("Wszystkie pola muszą być wypełnione")</script>';
    header('refresh:0.1; url=../register.php');
}
