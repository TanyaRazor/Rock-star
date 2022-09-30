<?php
// $hostname = 'rockstar57.ru';
$hostname = '31.31.198.206';
$username = 'u1611848_default';
$password = 'MrX5umFtIC6yX68b5dSU';
$dbname = 'u1611848_rockstar_orel';


// $ip = gethostbyname('rockstar57.ru');
// echo $ip;

$con = mysqli_connect($hostname, $username, $password, $dbname);
if (!$con) {
  echo 'Ошибка к подключению БД'  . mysqli_connect_error();
}

mysqli_set_charset($con, "utf8mb4");