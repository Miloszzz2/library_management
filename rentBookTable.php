<?php
$currentpagenumber = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentpagenumber - 1) * 10;

$queryCount = $link->prepare("SELECT COUNT(*) as total FROM books");
$queryCount->execute();
$resultCount = $queryCount->get_result();
$row = $resultCount->fetch_assoc();
$numberofrows = $row['total'];

$totalPages = ceil($numberofrows / 10);

$query = $link->prepare("SELECT * FROM books LIMIT 10 OFFSET ?");
$query->bind_param('i', $offset);
$query->execute();
$result = $query->get_result();


$query2 = $link->prepare("SELECT * FROM users WHERE email=?");
$query2->bind_param('s', explode(" ", $_SESSION['user'])[0]);
$query2->execute();
$result2 = $query2->get_result();
while ($row = $result2->fetch_assoc()) {
    $currentuserid =  $row['id'];
}
?>
<div class="d-flex flex-column align-items-center">
    <h2 class="mb-4">Wypożycz książkę</h2>
    <h5 class='mb-4'>Chcesz zobaczyć swoje wypożyczenia ---> <a href="rents.php" class='btn btn-primary'>Zobacz wypożyczenia</a></h4>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Tytuł</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Wydawnictwo</th>
                    <th scope="col">Wolne egzemplarze</th>
                    <th class="col"></th>
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
                    $wolneegzemplarze = $row['wolneegzemplarze'];

                    if ($wolneegzemplarze > 0) {
                        echo "<tr>";
                        echo "<th scope='row'>{$i}</th>";
                        echo "<td>{$tytul}</td>";
                        echo "<td>{$autor}</td>";
                        echo "<td>{$wydawnictwo}</td>";
                        echo "<td>{$wolneegzemplarze}</td>";
                        echo "<td class='text-center'><form action='logic/rentBookLogic.php' method='post'><input class='d-none' name='user_id' value='{$currentuserid}'><input class='d-none' name='book_id' value='{$id}'><button type='submit' class='btn btn-primary'>Wypożycz</button></form></td>";
                        echo "</tr>";
                        $i++;
                    }
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