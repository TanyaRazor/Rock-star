<?php
$hostname = 'rockstar57.ru';
$username = 'u1611848_default';
$password = 'MrX5umFtIC6yX68b5dSU';
$dbname = 'u1611848_rockstar_orel';

$con = mysqli_connect($hostname, $username, $password, $dbname);
if (!$con) {
  echo 'Ошибка к подключению БД'  . mysqli_connect_error();
}

mysqli_set_charset($con, "utf8mb4");