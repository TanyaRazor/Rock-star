<?php include 'config.php';
// $log_bd = '';
// $pass_bd = md5("");
// $user_add = mysqli_query($con, "INSERT INTO `users` (`id`,`имя`, `пароль`, `роль`) VALUES (NULL,'$log_bd', '$pass_bd', '')");

if (isset($_POST['btn_login'])) {
  $login = $_POST['login'];
  $password = md5($_POST['password']);


  $sql = mysqli_query($con, "SELECT * FROM `users` WHERE `имя` = '$login'");
  $user = mysqli_fetch_assoc($sql);

  $pass = $user['пароль'];
  $role = $user['роль'];

  if ($password == $pass && $role == 'admin'){
    session_start();
    $_SESSION['admin'] = true;
    $script = 'admin.php';
  }else{
    $script = 'login.php';
  }
  header("Location: $script");
}?>
<!DOCTYPE html>
<html lang="ru">
<?php include 'head.html';?>

<body>
    <div class="section-login">
      <div class="container-fluid section-login__container">
        <fieldset class="fieldset fieldset-login">
          <legend>Авторизация</legend>
          <form action="" method="post">
            <input class="form-control" name="login" placeholder="Логин">
            <input class="form-control" type="password" name="password" placeholder="Пароль">
            <input type="submit" class="btn btn-primary" name="btn_login" value="Войти">
          </form>
        </fieldset>
      </div>
    </div>
</body>

</html>
