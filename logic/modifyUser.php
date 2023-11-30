<?php
include '../config.php';
if (isset($_POST['nazwisko']) && !empty($_POST['nazwisko'])) {
    $id = $_POST['id'];
    $nazwisko = $_POST['nazwisko'];

    $query = $link->prepare("UPDATE users SET nazwisko=? WHERE id=?");
    $query->bind_param('si', $nazwisko, $id);
    $query->execute();
    header("Location: ../admin.php");
}
if (isset($_POST['imie']) && !empty($_POST['imie'])) {
    $id = $_POST['id'];
    $imie = $_POST['imie'];

    $query = $link->prepare("UPDATE users SET imie=? WHERE id=?");
    $query->bind_param('si', $imie, $id);
    $query->execute();
    header("Location: ../admin.php");
}
if (isset($_POST['email']) && !empty($_POST['email'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];

    $query = $link->prepare("UPDATE users SET email=? WHERE id=?");
    $query->bind_param('si', $email, $id);
    $query->execute();
    header("Location: ../admin.php");
}
if (isset($_POST['haslo']) && !empty($_POST['haslo'])) {
    $id = $_POST['id'];
    $haslo = hash('sha256', $_POST['haslo']);

    $query = $link->prepare("UPDATE users SET haslo=? WHERE id=?");
    $query->bind_param('si', $haslo, $id);
    $query->execute();
    header("Location: ../admin.php");
}
if (isset($_POST['rola']) && !empty($_POST['rola'])) {
    $id = $_POST['id'];
    $rola = $_POST['rola'];
    if ($rola === 'użytkownik') {
        $rola = 'uzytkownik';
    }

    $query = $link->prepare("UPDATE users SET rola=? WHERE id=?");
    $query->bind_param('si', $rola, $id);
    $query->execute();
    header("Location: ../admin.php");
}
