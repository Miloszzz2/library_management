<?php
include '../config.php';
if (isset($_POST['tytul']) && !empty($_POST['tytul']) && !empty($_POST['autor']) && !empty($_POST['wydawnictwo']) && !empty($_POST['liczbasztuk'])) {
    $tytul = $_POST['tytul'];
    $autor = $_POST['autor'];
    $wydawnictwo = $_POST['wydawnictwo'];
    $liczba = $_POST['liczbasztuk'] * 1;
    $query = $link->prepare("INSERT INTO books VALUES (NULL, ?, ?, ?, ?)");
    $query->bind_param('sssi', $tytul, $autor, $wydawnictwo, $liczba);
    $query->execute();
    header("Location: ../admin.php");
} else {
    echo '<script>alert("Wszystkie pola muszą być wypełnione")</script>';
    header('refresh:0.1; url=../admin.php');
}
