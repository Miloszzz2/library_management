<?php
session_start();
include './config.php';
if (!isset($_SESSION['userrole']) && ($_SESSION['userrole'] == 'gosc')) {
    echo '<script>alert("Odmowa dostepu")</script>';
    session_destroy();
    header("refresh:0.0001; url=index.php");
}
$query2 = $link->prepare("SELECT * FROM users WHERE email=?");
$query2->bind_param('s', explode(" ", $_SESSION['user'])[0]);
$query2->execute();
$result2 = $query2->get_result();
while ($row = $result2->fetch_assoc()) {
    $currentuserid =  $row['id'];
}
$currentpagenumber = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentpagenumber - 1) * 10;

$queryCount = $link->prepare("SELECT count(*) as total FROM books WHERE id IN(SELECT book_id from wypozyczenia WHERE user_id=?) ");
$queryCount->bind_param('i', $currentuserid);
$queryCount->execute();
$resultCount = $queryCount->get_result();
$row = $resultCount->fetch_assoc();
$numberofrows = $row['total'];

$totalPages = ceil($numberofrows / 10);

$query = $link->prepare("SELECT * FROM books WHERE id IN(SELECT book_id from wypozyczenia WHERE user_id=?) LIMIT 10 OFFSET ? ");
$query->bind_param('ii', $currentuserid, $offset);
$query->execute();
$result = $query->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex flex-column align-items-center p-3">
        <h2 class="mb-4">Twoje wypożyczenia</h2>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Tytuł</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Wydawnictwo</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $i = ($currentpagenumber - 1) * 10 + 1;

                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $tytul = $row['tytul'];
                    $autor = $row['autor'];
                    $wydawnictwo = $row['wydawnictwo'];
                    echo "<tr>";
                    echo "<th scope='row'>{$i}</th>";
                    echo "<td>{$tytul}</td>";
                    echo "<td>{$autor}</td>";
                    echo "<td>{$wydawnictwo}</td>";
                    echo "</tr>";
                    $i++;
                }
                ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo ($currentpagenumber > 1) ? ($currentpagenumber - 1) : 1; ?>">Previous</a>
                </li>
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo "<li class='page-item'><a class='page-link' href='?page={$i}'>{$i}</a></li>";
                }
                ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo ($currentpagenumber < $totalPages) ? ($currentpagenumber + 1) : $totalPages; ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</body>

</html>