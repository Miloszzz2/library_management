<?php
include '../config.php';
if (isset($_POST['idnumber'])) {
    $id = $_POST['idnumber'];
    $query = $link->prepare("DELETE FROM books WHERE id=?");
    $query->bind_param('i', $id);
    $query->execute();
    header("Location: ../admin.php");
}
