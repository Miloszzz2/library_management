<?php
include '../config.php';
$title = 0;
$autor = 0;
$wydawnictwo = 0;
$liczbasztuk = 0;
if ((isset($_POST['tytul']) && !empty($_POST['tytul']))) {
    $tytul = $_POST['tytul'];
}
if (isset($_POST['autor']) && !empty($_POST['autor'])) {
    $autor = $_POST['autor'];
}
if (isset($_POST['wydawnictwo']) && !empty($_POST['wydawnictwo'])) {
    $wydawnictwo = $_POST['wydawnictwo'];
}
if (isset($_POST['liczbasztuk']) && !empty($_POST['liczbasztuk'])) {
    $liczbasztuk = $_POST['liczbasztuk'];
}
if ($title == 0 && $autor == 0 && $wydawnictwo == 0 && $liczbasztuk == 0) {
    echo '<script>alert("Wszystkie pola muszą być wypełnione")</script>';
    header('refresh:0.1; url=../admin.php');
} else {
    $q1 = "";
    $id = $_POST['idbook'];
    if ($title != 0) {
        $query = $link->prepare("UPDATE books SET title=? WHERE id=?");
        $query->bind_param('si', $title, $id);
        $query->execute();
    }
    if ($autor != 0) {
        $query = $link->prepare("UPDATE books SET autor=? WHERE id=?");
        $query->bind_param('si', $autor, $id);
        $query->execute();
    }
    if ($wydawnictwo != 0) {
        $query = $link->prepare("UPDATE books SET wydawnictwo=? WHERE id=?");
        $query->bind_param('si', $wydawnictwo, $id);
        $query->execute();
    }
    if ($liczbasztuk != 0) {
        $query = $link->prepare("UPDATE books SET wolneegzemplarze=? WHERE id=?");
        $query->bind_param('si', $liczbasztuk, $id);
        $query->execute();
    }
    header("Location: ../admin.php");
}
