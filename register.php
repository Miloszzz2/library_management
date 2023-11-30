<?php


include './config.php';
?>
<!DOCTYPE html>
<html lang="PL-pl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rejestracja</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="w-25 p-4">
        <h2 class="mb-4">Rejestracja: </h2>
        <form action="logic/registerLogic.php" method="POST">
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
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="agreement" />
                <label class="form-check-label" for="exampleCheck1">Akceptujesz warunki umowy</label>
            </div>
            <button type="submit" class="btn btn-primary">Zarejestruj się </button>
            <hr>


        </form>
        <div class="text-center">
            <p>lub kontynnuj jako gość</p>
            <form action="logic/guestLogic.php" method="POST">
                <button class="btn btn-secondary" type="submit">Gość</button>
            </form>

        </div>
    </div>
</body>

</html>