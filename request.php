<?php include 'config.php';

// $sql = "SELECT `Концерты`.`дата_время_начала` as `Дата и время начала`, `Группы`.`name` as `Группа`, `Тип_концерта`.`имя` as `Тип`, `Условия_выступления`.`имя` as `Условия выступления`, `Концерты`.`комментарий` as `Условия`, `Концерты`.`расходы` as `Расходы`, `Статус_переговоров`.`имя`as `Статус переговоров`
//   . "FROM `Концерты`, `Тип_концерта`,`Условия_выступления`,`Группы`, `Статус_переговоров`
//   . "WHERE `Концерты`.`группа`=`Группы`.`id` AND `Концерты`.`тип_концерта`=`Тип_концерта`.`id` AND `Концерты`.`условия`=`Условия_выступления`.`id` AND `Концерты`.`статус_переговоров`=`Статус_переговоров`.`id`";

// $sql_concerts = "SELECT `Концерты`.`дата_время_начала` as `Дата и время начала`, `Группы`.`name` as `Группа`, `Тип_концерта`.`имя` as `Тип`, `Условия_выступления`.`имя` as `Условия выступления`, `Концерты`.`комментарий` as `Условия`, `Концерты`.`расходы` as `Расходы`, `Статус_переговоров`.`имя`as `Статус переговоров`";

$sql = mysqli_query($con, "SELECT date(`дата_время_начала`) as `Дата`,  `Группы`.`name` as `Группа` from `Группы`, `Концерты` WHERE `Концерты`.`группа`=`Группы`.`id` and date(`дата_время_начала`) >= CURRENT_DATE");

$sql1 = mysqli_query($con, "SELECT * FROM `Город` ORDER BY `имя`");

$sql2 = mysqli_query($con, "SELECT * FROM `Страна` ORDER BY `имя`");

$sql3 = mysqli_query($con,"SELECT * FROM `Группы` ORDER BY `name`");

$sql4 = mysqli_query($con, "SELECT * FROM `Тип_концерта`");

$sql5 = mysqli_query($con, "SELECT * FROM `Условия_выступления`");

$sql6 = mysqli_query($con, "SELECT * FROM `Статус_переговоров`");

$sql7 = mysqli_query($con, "SELECT `Концерты`.`id` as `id`, `Концерты`.`дата_время_начала` as `Дата`, `Группы`.`name` as `Группа`, `Тип_концерта`.`имя` as `Тип`, `Условия_выступления`.`имя` as `Условия выступления`, `Концерты`.`комментарий` as `Комментарий`, `Концерты`.`расходы` as `Расходы`, `Статус_переговоров`.`имя`as `Статус переговоров` FROM `Концерты`, `Тип_концерта`,`Условия_выступления`,`Группы`, `Статус_переговоров` WHERE `Концерты`.`группа`=`Группы`.`id` AND `Концерты`.`тип_концерта`=`Тип_концерта`.`id` AND `Концерты`.`условия`=`Условия_выступления`.`id` AND `Концерты`.`статус_переговоров`=`Статус_переговоров`.`id` ORDER BY `Дата` ASC");

$sql8 = mysqli_query($con, "SELECT `Представитель`.`имя` as `Имя`, `Представитель`.`телефон` as `Телефон`, `Город`.`имя` AS `Город` FROM `Представитель`, `Город` WHERE `Город`.`id` = `Представитель`.`id_города` ORDER BY `Представитель`.`имя` ASC");

$sql9 = mysqli_query($con, "SELECT * FROM `Жанр_группы`");

// $sql4 = mysqli_query($con, "SELECT * FROM `Тип_концерта`");
// $sql4 = mysqli_query($con, "SELECT * FROM `Тип_концерта`");
// $sql4 = mysqli_query($con, "SELECT * FROM `Тип_концерта`");
// $sql4 = mysqli_query($con, "SELECT * FROM `Тип_концерта`");
// $sql4 = mysqli_query($con, "SELECT * FROM `Тип_концерта`");
// $sql4 = mysqli_query($con, "SELECT * FROM `Тип_концерта`");

$dir = 'img/афиши';
$res_array = array();
$city_array = array();
$country_array = array();
$group_array = array();
$type_concert_array = array();
$conditions_array = array();
$status_array = array();
$concerts_array = array();
$director_array = array();
$genre_array = array();

while ($rows = mysqli_fetch_assoc($sql)) {
  $res_array[][] = $rows;
}

while ($rows = mysqli_fetch_assoc($sql1)) {
  $city_array[][] = $rows;
}

while ($rows = mysqli_fetch_assoc($sql2)) {
  $country_array[][] = $rows;
}

while ($rows = mysqli_fetch_assoc($sql3)) {
  $group_array[][] = $rows;
}

while ($rows = mysqli_fetch_assoc($sql4)) {
  $type_concert_array[][] = $rows;
}

while ($rows = mysqli_fetch_assoc($sql5)) {
  $conditions_array[][] = $rows;
}

while ($rows = mysqli_fetch_assoc($sql6)) {
  $status_array[][] = $rows;
}

while ($rows = mysqli_fetch_assoc($sql7)) {
  $concerts_array[][] = $rows;
}

while ($rows = mysqli_fetch_assoc($sql8)) {
  $director_array[][] = $rows;
}

while ($rows = mysqli_fetch_assoc($sql9)) {
  $genre_array[][] = $rows;
}
// while ($rows = mysqli_fetch_assoc($sql8)) {
//   $director_array[][] = $rows;
// }
// while ($rows = mysqli_fetch_assoc($sql8)) {
//   $director_array[][] = $rows;
// }

if (isset($_GET['delete_id'])) {
  $sql = mysqli_query($con, "DELETE FROM `Концерты` WHERE `ID` = {$_GET['delete_id']}");
  if ($sql) {
    header("Refresh: 1;".$_SERVER["HTTP_REFERER"]);
    exit;
  } else {
    header("Refresh: 1;".$_SERVER["HTTP_REFERER"]);
    exit;
  }
}





if (isset($_POST['btn_city'])) {
    $city_name = $con->real_escape_string($_POST['city']);
    $country_name = $con->real_escape_string($_POST['countries']);

    $country_id = mysqli_query($con, "SELECT `id` FROM `Страна` WHERE `имя`=\"$country_name\"");

    foreach ($country_id as $c_id){
      $country_id = $c_id['id'];
    }

    $city_add = mysqli_query($con, "INSERT INTO `Город` (`id`,`имя`, `id_страны`) VALUES (NULL,'$city_name', '$country_id')");

    header("Refresh: 1;".$_SERVER["HTTP_REFERER"]);
    exit;
}

if (isset($_POST['btn_genres'])) {
  $agent_name = $con->real_escape_string($_POST['agent']);
  $phone = $con->real_escape_string($_POST['phone']);
  $city_name = $con->real_escape_string($_POST['cities']);

  $city_id = mysqli_query($con, "SELECT `id` FROM `Город` WHERE `имя`=\"$city_name\"");

  foreach ($city_id as $c_id){
    $city_id = $c_id['id'];
  }

  $agent_add = mysqli_query($con, "INSERT INTO `Представитель` (`id`,`имя`, `телефон`, `id_города`) VALUES (NULL, '$agent_name', '$phone' ,'$city_id')");

  header("Refresh: 1;".$_SERVER["HTTP_REFERER"]);
    exit;
}

if (isset($_POST['btn_groups'])) {
  $group_name = $con->real_escape_string($_POST['group']);
  $agent_name = $con->real_escape_string($_POST['agents']);

  $agent_id = mysqli_query($con, "SELECT `id` FROM `Представитель` WHERE `имя`=\"$agent_name\"");
  foreach ($agent_id as $a_id){
    $agent_id = $a_id['id'];
  }

  $genre_name = $con->real_escape_string($_POST['genre']);

  if ($genre_name == NULL){
    $genre_id = '0';
  }else{
    $genre_id = mysqli_query($con, "SELECT `id` FROM `Жанр_группы` WHERE `имя`=\"$genre_name\"");
  }

  foreach ($genre_id as $g_id){
    $genre_id = $g_id['id'];
  }


  $group_add = mysqli_query($con, "INSERT INTO `Группы` (`id`,`name`, `id_agent`,`id_жанра`) VALUES (NULL,'$group_name','$agent_id','$genre_id')");

  header("Refresh: 1;".$_SERVER["HTTP_REFERER"]);
    exit;
}





if (isset($_POST['add_concert'])) {

  $date = $con->real_escape_string($_POST['date']);
  $group_name = $con->real_escape_string($_POST['groups']);
  $type_name = $con->real_escape_string($_POST['type_concert']);
  $condition_name = $con->real_escape_string($_POST['conditions']);
  $status_name = $con->real_escape_string($_POST['status']);


  $group_id = mysqli_query($con, "SELECT * FROM `Группы` WHERE `name` = \"$group_name\"");
  $type_id = mysqli_query($con, "SELECT * FROM `Тип_концерта` WHERE `имя` = \"$type_name\"");
  $condition_id = mysqli_query($con, "SELECT * FROM `Условия_выступления` WHERE `имя` = \"$condition_name\"");
  $status_id = mysqli_query($con, "SELECT * FROM `Статус_переговоров` WHERE `имя` = \"$status_name\"");

  foreach ($group_id as $g){
    $group_id = $g['id'];
  }
  foreach ($type_id as $t){
    $type_id = $t['id'];
  }
  foreach ($condition_id as $c){
    $condition_id = $c['id'];
  }
  foreach ($status_id as $st){
    $status_id = $st['id'];
  }

  $comment = $con->real_escape_string($_POST['comments']);

  if(!empty($_POST['costs'])){
    $costs = 1;
  }else{
    $costs = 0;
  }

  $concert_add =  mysqli_query($con, "INSERT INTO `Концерты` (`id`, `дата_время_начала`,`группа`, `тип_концерта`, `условия`,`комментарий`,`расходы`,`статус_переговоров`) VALUES (NULL, \"$date\", \"$group_id\", \"$type_id\", \"$condition_id\", \"$comment\", \"$costs\", \"$status_id\")");

  header("Refresh: 1;".$_SERVER["HTTP_REFERER"]);
    exit;
}


if (isset($_POST['edit_concert'])) {

  $id = ($_POST['id_edit']);
  $date = $con->real_escape_string($_POST['date_edit']);
  $group_name = $con->real_escape_string($_POST['group_edit']);
  $type_name = $con->real_escape_string($_POST['type_concert_edit']);
  $condition_name = $con->real_escape_string($_POST['condition_edit']);
  $comment_edit = $con->real_escape_string($_POST['comments_edit']);

  $status_name = $con->real_escape_string($_POST['status_edit']);


  $group_id = mysqli_query($con, "SELECT * FROM `Группы` WHERE `name` = \"$group_name\"");
  $type_id = mysqli_query($con, "SELECT * FROM `Тип_концерта` WHERE `имя` = \"$type_name\"");
  $condition_id = mysqli_query($con, "SELECT * FROM `Условия_выступления` WHERE `имя` = \"$condition_name\"");
  $status_id = mysqli_query($con, "SELECT * FROM `Статус_переговоров` WHERE `имя` = \"$status_name\"");

  foreach ($group_id as $g){
    $group_id = $g['id'];
  }
  foreach ($type_id as $t){
    $type_id = $t['id'];
  }
  foreach ($condition_id as $c){
    $condition_id = $c['id'];
  }
  foreach ($status_id as $st){
    $status_id = $st['id'];
  }

  if(!empty($_POST['costs_edit'])){
    $costs_edit = 1;
  }else{
    $costs_edit = 0;
  }

$sql = mysqli_query($con, "UPDATE `Концерты` SET `дата_время_начала`='$date', `группа`='$group_id', `тип_концерта`='$type_id', `условия`='$condition_id', `комментарий`='$comment_edit', `расходы`='$costs_edit', `статус_переговоров`='$status_id' WHERE `Концерты`.`id` = '$id'");
  if ($sql) {
    header("Refresh: 1;" ."/admin.php");
    exit;
  } else {
    header("Refresh: 1;" ."/admin.php");
    exit;
  }
}

// $res_sql_concerts = mysqli_query($con, $sql_concerts);

// echo "$row";

// foreach ($f as $file){
//   if(preg_match('/\.(jpg)/', $file)){
//     echo "<img class=\"section-events__fon-img\" src=\"$dir$file\" alt=\"fon\"/>";
//   }
// }

//   if ($res == false) {
//     print("Произошла ошибка при выполнении запроса");
// }

// $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

// $dir = 'img/афиши/';
          // $f = scandir($dir);
          // foreach ($f as $file){
          //     if(preg_match('/\.(jpg)/', $file)){
          //         echo "<img class=\"section-events__fon-img\" src=\"$dir$file\" alt=\"fon\"/>";
          //     }
          // }


?>