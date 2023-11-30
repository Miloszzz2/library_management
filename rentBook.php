<?php
session_start();
include './config.php';
if (!isset($_SESSION['userrole']) && ($_SESSION['userrole'] == 'gosc')) {
    echo '<script>alert("Odmowa dostepu")</script>';
    session_destroy();
    header("refresh:0.0001; url=index.php");
}

include './config.php';

$query2 = $link->prepare("SELECT * FROM users WHERE email=?");
$query2->bind_param('s', explode(" ", $_SESSION['user'])[0]);
$query2->execute();
$result2 = $query2->get_result();
while ($row = $result2->fetch_assoc()) {
    $currentuserid =  $row['id'];
}

?>
<!DOCTYPE html>
<html lang="PL-pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wypożyczalnia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <main class="p-3">
        <?php
        include './rentBookTable.php';
        ?>
    </main>
</body>

</html>