<?php
// ini_set('display_errors',1); 
// error_reporting(E_ALL);
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
session_start();
include './config.php';
$query = $link->prepare("SELECT Nazwa FROM tabela");
$query->execute();
$result = $query->get_result();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="./style.css" rel="stylesheet">
  <title></title>
</head>

<body>
  <?php
  #    while ($row = $result->fetch_assoc()) {
  #     $res = $row['Nazwa'];
  #     echo $res."\n";
  #   }
  ?>
  <nav class="d-flex justify-content-between p-3 border-bottom border-2 align-items-center">
    <h3>Biblioteka</h3>
    <div class="d-flex gap-2 align-items-center">
      <?php
      if (isset($_SESSION['user'])) {
        echo '<h6 class="m-0">Witaj ponownie ' .  ucfirst(explode("@", $_SESSION['user'])[0]) . '</h6>';
        echo '<form action="logic/logoutLogic.php" method="POST">
              <button type="submit" class="btn btn-secondary">Wyloguj</button>
              </form>';
      } else {
        echo '<a href="login.php" class="btn btn-primary">Logowanie</a>';
        echo '<a href="register.php" class="btn btn-secondary">Rejestracja</a>';
        echo '<form action="logic/guestLogic.php" method="POST">
                <button class="btn btn-outline-secondary" type="submit">Gość</button>
            </form>';
      }
      ?>
    </div>

  </nav>
  <main class="text-center d-flex flex-column align-items-center justify-content-center p-3">
    <?php
    if (isset($_SESSION['userrole']) && ($_SESSION['userrole'] === 'uzytkownik' || $_SESSION['userrole'] === 'administrator')) {
      include 'userpanel.php';
    }
    if (isset($_SESSION['userrole']) && ($_SESSION['userrole'] === 'gosc' || $_SESSION['userrole'] === 'administrator' | $_SESSION['userrole'] === 'uzytkownik')) {
      include 'guestpanel.php';
    }
    if (isset($_SESSION['userrole']) && $_SESSION['userrole'] === 'administrator') {
      echo '<a href="admin.php" class="btn btn-primary">Przejdź do panelu admina</a>';
    }
    if (!isset($_SESSION['userrole'])) echo "<h2 class='mt-5 pt-5'>Aby skorzystać z funkcji naszego portalu zaloguj się lub kontynuuj jako gość</h2><img class='mt-3 pt-2' src='img/zapraszamy.png'>";
    ?>


  </main>
</body>

</html>