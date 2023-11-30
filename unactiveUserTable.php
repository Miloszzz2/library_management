<?php
$currentpagenumber = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentpagenumber - 1) * 10;

$queryCount = $link->prepare("SELECT COUNT(*) as total FROM users");
$queryCount->execute();
$resultCount = $queryCount->get_result();
$row = $resultCount->fetch_assoc();
$numberofrows = $row['total'];

$totalPages = ceil($numberofrows / 10);

$query = $link->prepare("SELECT * FROM users LIMIT 10 OFFSET ?");
$query->bind_param('i', $offset);
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
                    <th scope="col">Imię</th>
                    <th scope="col">Nazwisko</th>
                    <th scope="col">Email</th>
                    <th scope="col" style='width:200px; overflow:hidden;'>Hasło</th>
                    <th class="col">Rola</th>
                    <th class="col">Ważność</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = ($currentpagenumber - 1) * 10 + 1;
                $currentDate = new DateTime();
                $currentDate = $currentDate->format('Y-m-d');
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $imie = $row['imie'];
                    $nazwisko = $row['nazwisko'];
                    $email = $row['email'];
                    $haslo = $row['haslo'];
                    $rola = $row['rola'];
                    $waznoscKonta = $row['waznoscKonta'];

                    if ($waznoscKonta <= $currentDate) {
                        echo "<tr>";
                        echo "<th scope='row'>{$i}</th>";
                        echo "<td >{$imie}</td>";
                        echo "<td >{$nazwisko}</td>";
                        echo "<td >{$email}</td>";
                        echo "<td style='max-width:200px; overflow:auto;'>{$haslo}</td>";
                        echo "<td >{$rola}</td>";
                        echo "<td >{$waznoscKonta}</td>";
                        echo "<td><form action='logic/manageUser.php' method='post'><input type='text' name='user_id' value='{$id}' class='d-none'/><button type='submit' class='btn btn-danger' name='delete_user'>Usuń</button></form></td>";
                        echo "</tr>";
                        $i++;
                    }
                }
                if ($i == 1) {
                    echo "<tr class='text-center'>";
                    echo "<th scope='row'>Nie</th>";
                    echo "<td >żadnych</td>";
                    echo "<td >nieaktywnych</td>";
                    echo "<td >kont</td>";
                    echo "<td style='max-width:200px; overflow:auto;'>w</td>";
                    echo "<td >naszym</td>";
                    echo "<td >serwisie</td>";
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