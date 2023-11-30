<div class="py-3 w-100 d-flex flex-column  align-items-center">
    <h3>Wyszukiwarka książek</h3>
    <p>Wyszukaj po:</p>

    <form action="index.php" method="post" class="d-flex flex-column w-100 justify-content-center align-items-center gap-2">
        <select name="filter" class="form-select w-25" id="filter-form">
            <option value="tytule">Tytule</option>
            <option value="wydawnictwie">Wydawnictwie</option>
            <option value="autorze">Autorze</option>
        </select>
        <div class="w-75">
            <input name="search" type="text" class="form-control mb-2" id="search-input" placeholder="Wyszukaj po tytule" />
            <button class="btn btn-primary" type="submit">Szukaj</button>
        </div>
    </form>
    <?php
    if (isset($_POST['filter'])) {
        $value = $_POST['filter'];
        switch ($value) {
            case 'tytule':
                $query = $link->prepare("SELECT * FROM  books WHERE tytul=?");
                break;
            case 'wydawnictwie':
                $query = $link->prepare("SELECT * FROM  books WHERE wydawnictwo=?");
                break;
            case 'autorze':
                $query = $link->prepare("SELECT * FROM  books WHERE autor=?");
                break;
            default:
                # code...
                break;
        }
        if (!empty($_POST['search'])) {
            $search_param = $_POST['search'];
            $query->bind_param('s', $search_param);
            $query->execute();
            $result = $query->get_result();
            $liczba = mysqli_num_rows($result);
            $wiersz = '';
            if ($liczba == 1) {
                $wiersz = 'wiersz';
            } else if ($liczba <= 4) {
                $wiersz = 'wiersze';
            } else {
                $wiersz = 'wierszy';
            }
            if ($liczba === 0) {
                echo "<h4 class='mt-4'>Nie znaleziono ksiażek</h4>";
            } else echo "<h5 class='mt-4'>Zwrócono {$liczba} {$wiersz}</h5>";
            echo "<ol class='text-start'>";
            while ($row = $result->fetch_assoc()) {
                $tytul = $row['tytul'];
                $autor = $row['autor'];
                $wydawnictwo = $row['wydawnictwo'];
                $wolneegzemplarze = $row['wolneegzemplarze'];
                echo "<li>{$tytul} {$autor} {$wydawnictwo}, liczba wolnych egzamplarzy:<b> {$wolneegzemplarze}</b></li>";
            }
            echo "</ol>";
        }
    }
    ?>
</div>
<script src="script.js"></script>