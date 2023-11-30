<?php
include '../config.php';
if (isset($_POST['book_id']) && !empty($_POST['book_id']) && !empty($_POST['user_id'])) {
    $id = $_POST['book_id'];
    $currentuserid = $_POST['user_id'];
    $currentDate = new DateTime();
    $currentDate2 = new DateTime();
    $currentDate2 = $currentDate2->format('Y-m-d');
    $currentDate->modify('+30 days');
    $futureDate = $currentDate->format('Y-m-d');
    $query = $link->prepare("INSERT into wypozyczenia values (NULL, ?,?,?,?)");
    $query->bind_param('iiss', $currentuserid, $id, $currentDate2, $futureDate);
    $query->execute();
    $query2 = $link->prepare("UPDATE books SET wolneegzemplarze= wolneegzemplarze-1 WHERE id=?");
    $query2->bind_param('i', $id);
    $query2->execute();
    header('Location: ../rentBook.php');
}
