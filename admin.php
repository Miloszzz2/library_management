<?php
include './config.php';
session_start();
if (!isset($_SESSION['userrole']) || $_SESSION['userrole'] != 'administrator') {
    echo '<script>alert("Odmowa dostepu")</script>';
    header("refresh:0.0001; url=index.php");
}
$query2 = $link->prepare("SELECT * FROM users WHERE email=?");
$query2->bind_param('s', explode(" ", $_SESSION['user'])[0]);
$query2->execute();
$result2 = $query2->get_result();
while ($row = $result2->fetch_assoc()) {
    $currentuserid =  $row['id'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administratora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    if (isset($_SESSION['userrole']) && $_SESSION['userrole'] === 'administrator') {
    ?>
        <main class="p-3 mt-2  d-flex flex-column justify-content-between ">
            <div class="d-flex justify-content-between">
                <h2 class="mb-5">Panel admina</h2>
                <form action="logic/logoutLogic.php" method="POST">
                    <button type="submit" class="btn btn-secondary">Wyloguj</button>
                </form>
            </div>

            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3 " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-add-tab" data-bs-toggle="pill" data-bs-target="#v-pills-add" type="button" role="tab" aria-controls="v-pills-add" aria-selected="true">Dodawnie książek</button>
                    <button class="nav-link" id="v-pills-delete-tab" data-bs-toggle="pill" data-bs-target="#v-pills-delete" type="button" role="tab" aria-controls="v-pills-delete" aria-selected="false">Usuwanie książek</button>
                    <button class="nav-link" id="v-pills-modify-tab" data-bs-toggle="pill" data-bs-target="#v-pills-modify" type="button" role="tab" aria-controls="v-pills-modify" aria-selected="false">Modyfikacja książek</button>
                    <button class="nav-link" id="v-pills-manage-tab" data-bs-toggle="pill" data-bs-target="#v-pills-manage" type="button" role="tab" aria-controls="v-pills-manage" aria-selected="false">Zarządzanie użytkownikami</button>
                    <button class="nav-link" id="v-pills-unactive-tab" data-bs-toggle="pill" data-bs-target="#v-pills-unactive" type="button" role="tab" aria-controls="v-pills-unactive" aria-selected="false">Nie aktywni użytkownicy</button>
                    <button class="nav-link" id="v-pills-unactivebooks-tab" data-bs-toggle="pill" data-bs-target="#v-pills-unactivebooks" type="button" role="tab" aria-controls="v-pills-unactivebooks" aria-selected="false">Zaległe wypożyczenia</button>
                </div>
                <div class="tab-content w-100 pb-3 overflow-auto" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-add" role="tabpanel" aria-labelledby="v-pills-add-tab" tabindex="0">
                        <?php
                        include './addBook.php';
                        ?>
                    </div>
                    <div class="tab-pane fade" id="v-pills-delete" role="tabpanel" aria-labelledby="v-pills-delete-tab" tabindex="0">
                        <?php
                        $variables = ['Usuń', 'DELETE FROM books WHERE id=?', 'btn btn-danger', 'logic/deleteBook.php'];
                        include './admintable.php';
                        ?>
                    </div>
                    <div class="tab-pane fade" id="v-pills-modify" role="tabpanel" aria-labelledby="v-pills-modify-tab" tabindex="0">
                        <?php
                        $variables = ['Modyfikuj', '', 'btn btn-warning', 'logic/mofidyBook.php'];
                        include './admintable.php';
                        ?>
                    </div>
                    <div class="tab-pane fade" id="v-pills-manage" role="tabpanel" aria-labelledby="v-pills-manage-tab" tabindex="0">
                        <?php
                        include './usertable.php';
                        ?>
                    </div>
                    <div class="tab-pane fade" id="v-pills-unactive" role="tabpanel" aria-labelledby="v-pills-unactive-tab" tabindex="0">
                        <?php
                        include './unactiveUserTable.php';
                        ?>
                    </div>
                    <div class="tab-pane fade" id="v-pills-unactivebooks" role="tabpanel" aria-labelledby="v-pills-unactivebooks-tab" tabindex="0">
                        <?php
                        include './unactiveBooksTable.php';
                        ?>
                    </div>
                </div>
            </div>
            <a href="/" class="btn btn-secondary mt-2">Strona główna</a>
        </main>

    <?php
    };
    ?>
    <script src="script2.js"></script>
</body>

</html>