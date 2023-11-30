<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="./logic/modifyBook.php" method="POST">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modyfikacja książki</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Co chcesz zmienić?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="titleCheckbox" checked>
                        <label class="form-check-label" for="titleCheckbox">
                            Tytuł
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="authorCheckbox" checked>
                        <label class="form-check-label" for="authorCheckbox">
                            Autora
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="wCheckbox" checked>
                        <label class="form-check-label" for="wCheckbox">
                            Wydawnictwo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="copiesCheckbox" checked>
                        <label class="form-check-label" for="copiesCheckbox">
                            Liczbę egzemplarzy
                        </label>
                    </div>
                    <div class="form-group mt-4 mb-3 d-none" id="idgroup">
                        <input type="number" class="form-control" id="id_book" name='idbook'>
                    </div>
                    <div class="form-group mt-4 mb-3" id="titlegroup">
                        <label for="title" class="mb-1">Tytuł:</label>
                        <input type="text" class="form-control" id="title" placeholder="Wprowadź tytuł" name='tytul'>
                    </div>
                    <div class="form-group mb-3" id="authorgroup">
                        <label for="author" class="mb-1">Autor:</label>
                        <input type="text" class="form-control" id="author" placeholder="Wprowadź autora" name='autor'>
                    </div>
                    <div class="form-group mb-3 " id="wgroup">
                        <label for="publisher" class="mb-1">Wydawnictwo:</label>
                        <input type="text" class="form-control" id="publisher" placeholder="Wprowadź wydawnictwo" name='wydawnictwo'>
                    </div>
                    <div class="form-group " id="copiesgroup">
                        <label for="copies" class="mb-1">Liczba egzemplarzy:</label>
                        <input type="number" min=0 class="form-control" id="copies" placeholder="Wprowadź liczbę egzemplarzy" name='liczbasztuk'>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                    <button type="submit" class="btn btn-primary" name='idnumber' value="<?php echo $id ?>">Modyfikuj</button>
                </div>
            </form>
        </div>
    </div>
</div>