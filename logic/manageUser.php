<?php
include '../config.php';
if (isset($_POST['delete_user']) && !empty($_POST['user_id'])) {
    $id = $_POST['user_id'];
    $query = $link->prepare("DELETE FROM users WHERE id=?");
    $query->bind_param('i', $id);
    $query->execute();
    header("Location: ../admin.php");
}
