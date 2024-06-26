<?php
session_start();
?>
<!DOCTYPE html>
<html lang="PL-pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Logowanie</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="w-25 p-4">
    <h2 class="mb-4">Logowanie: </h2>
    <form method="POST" action="logic/loginLogic.php">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Hasło</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1" />
      </div>

      <button type="submit" class="btn btn-primary">Zaloguj się </button>
    </form>
  </div>
</body>

</html>