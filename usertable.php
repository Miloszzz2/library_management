<?php
if (!isset($_SESSION['userrole']) && ($_SESSION['userrole'] == 'gosc')) {
    echo '<script>alert("Odmowa dostepu")</script>';
    session_destroy();
    header("refresh:0.0001; url=index.php");
}
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
    <h2 class="mb-4">Zarządzaj użytkownikami</h2>
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

                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $imie = $row['imie'];
                    $nazwisko = $row['nazwisko'];
                    $email = $row['email'];
                    $haslo = $row['haslo'];
                    $rola = $row['rola'];
                    $waznoscKonta = $row['waznoscKonta'];
                    if ($id !== $currentuserid) {
                        echo "<tr>";
                        echo "<th scope='row'>{$i}</th>";
                        echo "<td onclick='changeElementToInput(this,{$id})' id='imie'>{$imie}</td>";
                        echo "<td onclick='changeElementToInput(this,{$id})' id='nazwisko'>{$nazwisko}</td>";
                        echo "<td onclick='changeElementToInput(this,{$id})' id='email'>{$email}</td>";
                        echo "<td onclick='changeElementToInput(this,{$id})' id='haslo' style='max-width:200px; overflow:auto;'>{$haslo}</td>";
                        echo "<td onclick='changeElementToInput(this,{$id})' id='rola'>{$rola}</td>";
                        echo "<td onclick='changeElementToInput(this,{$id})' id='waznoscKonta'>{$waznoscKonta}</td>";
                        echo "<td><button onclick='changeIdFormValue2({$id})' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#manageUserModal'>Zarządzaj</button></td>";
                        echo "</tr>";
                        $i++;
                    }
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

        <button class="btn btn-success" name="addUser" data-bs-toggle="modal" data-bs-target="#addUserModal">Dodaj użytkownika</button>

    </nav>
    <div class="modal fade" id="manageUserModal" tabindex="-1" aria-labelledby="manageUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="manageUserLabel">Zarządzaj użytkownikiem</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="logic/manageUser.php" method="post">
                        <input type="number" class="d-none form-control" name="user_id" id="user_id">
                        <button type="submit" class="btn btn-danger" name="delete_user">Usuń</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="logic/addUser.php" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addUserLabel">Dodaj użytkownika</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="imie" class="form-label">Imie</label>
                            <input type="text" class="form-control" id="imie" aria-describedby="imieHelp" name="imie" />
                        </div>
                        <div class="mb-3">
                            <label for="nazwisko" class="form-label">Nazwisko</label>
                            <input type="text" name="nazwisko" class="form-control" id="nazwisko" aria-describedby="nazwiskoHelp" />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Hasło</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" />
                        </div>
                        <div class="mb-3">
                            <label for="user_role" class="form-label">Hasło</label>
                            <select class="form-select" name="user_role" id="user_role">
                                <option value="uzytkownik">Użytkownik</option>
                                <option value="administrator">Administrator</option>
                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-success">Dodaj</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>