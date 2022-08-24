<?php
$hostname = 'rockstar57.ru';
$username = 'u1611848_default';
$password = 'MrX5umFtIC6yX68b5dSU';
$dbname = 'u1611848_rockstar_orel';

$con = mysqli_connect($hostname, $username, $password, $dbname);
if (!$con) {
  echo 'Ошибка к подключению БД'  . mysqli_connect_error();
}

mysqli_set_charset($con, "utf8");

$sql = "SELECT `Концерты`.`дата_время_начала` as `Дата и время начала`, `Группы`.`name` as `Группа`, `Тип_концерта`.`имя` as `Тип`, `Условия_выступления`.`имя` as `Условия выступления`, `Концерты`.`комментарий` as `Условия`, `Концерты`.`расходы` as `Расходы`, `Статус_переговоров`.`имя`as `Статус переговоров` \n"

  . "FROM `Концерты`, `Тип_концерта`,`Условия_выступления`,`Группы`, `Статус_переговоров` \n"

  . "WHERE `Концерты`.`группа`=`Группы`.`id` AND `Концерты`.`тип_концерта`=`Тип_концерта`.`id` AND `Концерты`.`условия`=`Условия_выступления`.`id` AND `Концерты`.`статус_переговоров`=`Статус_переговоров`.`id`";


  $res = mysqli_query($con, $sql);

//   if ($res == false) {
//     print("Произошла ошибка при выполнении запроса");
// }

$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

foreach ($rows as $v1) {
  foreach ($v1 as $row) {
      echo "$row\n";
  }
}
