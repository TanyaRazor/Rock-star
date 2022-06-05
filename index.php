<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Караоке бар Rock-star</title>
</head>

<body>
  <header class="section-header">
    <div class="container section-header__container">
      <h1 class="section-header__header">Караоке бар Rock-star</h1>

    </div>

  </header>

  <div class="section-one">
    <form action="" method="post">


    </form>
    <?php
    echo 'Привет<br>';

    $hostname = 'rockstar57.ru';
    $username = 'u1611848_default';
    $password = 'MrX5umFtIC6yX68b5dSU';
    $dbname = 'u1611848_rockstar_orel';


    $con = mysqli_connect($hostname, $username, $password);
    if ($con) {
      echo 'работает';
    } else {
      echo 'не работает';
    }

    echo $con;




    mysqli_close($con); ?>

    <p>text</p>
  </div>

  <footer class="section-footer">

  </footer>

</body>

</html>
