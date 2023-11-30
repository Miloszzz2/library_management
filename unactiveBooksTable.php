<?php
$currentpagenumber = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentpagenumber - 1) * 10;
$currentDate = new DateTime();
$currentDate = $currentDate->format('Y-m-d');
$queryCount = $link->prepare("SELECT COUNT(*) as total FROM wypozyczenia WHERE data_zwrotu<?");
$queryCount->bind_param('s', $currentDate);
$queryCount->execute();
$resultCount = $queryCount->get_result();
$row = $resultCount->fetch_assoc();
$numberofrows = $row['total'];

$totalPages = ceil($numberofrows / 10);

$query = $link->prepare("SELECT * FROM wypozyczenia WHERE data_zwrotu<? LIMIT 10 OFFSET ?");
$query->bind_param('si', $currentDate, $offset);
$query->execute();
$result = $query->get_result();

?>
<div class="d-flex flex-column align-items-center">
    <h2 class="mb-4">Baza książek</h2>
    <div>
        <table class="table table-bordered table-hover p-2">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Użytkownik</th>
                    <th scope="col">Książka</th>
                    <th scope="col">Data Wypożyczenia</th>
                    <th scope="col">Data Zwrotu</th>
                    <th>Opłata</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = ($currentpagenumber - 1) * 10 + 1;

                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $id_user = $row['user_id'];
                    $book_id = $row['book_id'];
                    $dataWypożyczenia = $row['data_wypożyczenia'];
                    $data_zwrotu = $row['data_zwrotu'];
                    $userquery = $link->prepare("SELECT concat(imie,' ', nazwisko) as razem from users where id=?");
                    $userquery->bind_param('i', $id_user);
                    $userquery->execute();
                    $userresult  = $userquery->get_result();
                    while ($row = $userresult->fetch_assoc()) {
                        $razem = $row['razem'];
                    }
                    $bookquery = $link->prepare("SELECT tytul from books where id=?");
                    $bookquery->bind_param('i', $book_id);
                    $bookquery->execute();
                    $bookresult  = $bookquery->get_result();
                    while ($row = $bookresult->fetch_assoc()) {
                        $tytul = $row['tytul'];
                    }
                    $date1 = strtotime($currentDate);
                    $date2 = strtotime($data_zwrotu);
                    $oplata = $date1 - $date2;
                    $oplata = ($oplata / (60 * 60 * 24)) * 0.5;
                    echo "<tr>";
                    echo "<th scope='row'>{$i}</th>";
                    echo "<td >{$razem}</td>";
                    echo "<td >{$tytul}</td>";
                    echo "<td >{$dataWypożyczenia}</td>";
                    echo "<td style='max-width:200px; overflow:auto;'>{$data_zwrotu}</td>";
                    echo "<td>{$oplata}</td>";
                    echo "</tr>";
                    $query4 = $link->prepare("UPDATE users set zaległeOpłaty=? where id=?");
                    $query4->bind_param('di', $oplata, $id_user);
                    $query4->execute();
                    $i++;
                }
                if ($i == 1) {
                    echo "<tr class='text-center'>";
                    echo "<th scope='row'>Brak</th>";
                    echo "<td >zaległych</td>";
                    echo "<td >wypożyczeń</td>";
                    echo "<td >w</td>";
                    echo "<td style='max-width:200px; overflow:auto;'>naszej</td>";
                    echo "<td >bazie</td>";
                    echo "<td >danych</td>";
                    echo "<td>:)</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
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