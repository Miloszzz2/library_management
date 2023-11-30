<form action="logic/addBookLogic.php" method="POST" class="w-100 d-flex flex-column gap-2 justify-content-center align-items-center">
    <h3>Dodawanie książki</h3>
    <div class="form-group  mb-3">
        <label for="title" class="mb-1">Tytuł:</label>
        <input type="text" class="form-control" id="title" placeholder="Wprowadź tytuł" name='tytul'>
    </div>
    <div class="form-group mb-3">
        <label for="author" class="mb-1">Autor:</label>
        <input type="text" class="form-control" id="author" placeholder="Wprowadź autora" name='autor'>
    </div>
    <div class="form-group mb-3">
        <label for="publisher" class="mb-1">Wydawnictwo:</label>
        <input type="text" class="form-control" id="publisher" placeholder="Wprowadź wydawnictwo" name='wydawnictwo'>
    </div>
    <div class="form-group">
        <label for="copies" class="mb-1">Liczba egzemplarzy:</label>
        <input type="number" min=0 class="form-control" id="copies" placeholder="Wprowadź liczbę egzemplarzy" name='liczbasztuk'>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Dodaj książkę</button>
</form>