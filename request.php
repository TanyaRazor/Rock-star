<?php include 'config.php';

// $sql = "SELECT `Концерты`.`дата_время_начала` as `Дата и время начала`, `Группы`.`name` as `Группа`, `Тип_концерта`.`имя` as `Тип`, `Условия_выступления`.`имя` as `Условия выступления`, `Концерты`.`комментарий` as `Условия`, `Концерты`.`расходы` as `Расходы`, `Статус_переговоров`.`имя`as `Статус переговоров`
//   . "FROM `Концерты`, `Тип_концерта`,`Условия_выступления`,`Группы`, `Статус_переговоров`
//   . "WHERE `Концерты`.`группа`=`Группы`.`id` AND `Концерты`.`тип_концерта`=`Тип_концерта`.`id` AND `Концерты`.`условия`=`Условия_выступления`.`id` AND `Концерты`.`статус_переговоров`=`Статус_переговоров`.`id`";

// $sql_concerts = "SELECT `Концерты`.`дата_время_начала` as `Дата и время начала`, `Группы`.`name` as `Группа`, `Тип_концерта`.`имя` as `Тип`, `Условия_выступления`.`имя` as `Условия выступления`, `Концерты`.`комментарий` as `Условия`, `Концерты`.`расходы` as `Расходы`, `Статус_переговоров`.`имя`as `Статус переговоров`";

$sql = mysqli_query($con, "SELECT date(`дата_время_начала`) as `Дата`,  `Группы`.`name` as `Группа` from `Группы`, `Концерты` WHERE `Концерты`.`группа`=`Группы`.`id` and date(`дата_время_начала`) >= CURRENT_DATE");

$sql1 = mysqli_query($con, "SELECT * FROM `Город`");

$sql2 = mysqli_query($con, "SELECT * FROM `Страна`");

$sql3 = mysqli_query($con,"SELECT * FROM `Группы`");

$sql4 = mysqli_query($con, "SELECT * FROM `Тип_концерта`");

$sql5 = mysqli_query($con, "SELECT * FROM `Условия_выступления`");

$sql6 = mysqli_query($con, "SELECT * FROM `Статус_переговоров`");

$sql7 = mysqli_query($con, "SELECT `Концерты`.`дата_время_начала` as `Дата и время начала`, `Группы`.`name` as `Группа`, `Тип_концерта`.`имя` as `Тип`, `Условия_выступления`.`имя` as `Условия выступления`, `Концерты`.`комментарий` as `Условия`, `Концерты`.`расходы` as `Расходы`, `Статус_переговоров`.`имя`as `Статус переговоров` FROM `Концерты`, `Тип_концерта`,`Условия_выступления`,`Группы`, `Статус_переговоров` WHERE `Концерты`.`группа`=`Группы`.`id` AND `Концерты`.`тип_концерта`=`Тип_концерта`.`id` AND `Концерты`.`условия`=`Условия_выступления`.`id` AND `Концерты`.`статус_переговоров`=`Статус_переговоров`.`id`");
// $sql4 = mysqli_query($con, "SELECT * FROM `Тип_концерта`");
// $sql4 = mysqli_query($con, "SELECT * FROM `Тип_концерта`");

$dir = 'img/афиши/';
$res_array = array();
$city_array = array();
$country_array = array();
$group_array = array();
$type_concert_array = array();
$conditions_array = array();
$status_array = array();
$concerts_array = array();

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





if (isset($_POST['btn_city'])) {
    $city_name = $con->real_escape_string($_POST['city']);
    $country_name = $con->real_escape_string($_POST['countries']);

    $country_id = mysqli_query($con, "SELECT `id` FROM `Страна` WHERE `имя`=\"$country_name\"");

    foreach ($country_id as $c_id){
      $country_id = $c_id['id'];
    }

    $city_add = mysqli_query($con, "INSERT INTO `Город` (`id`,`имя`, `id_страны`) VALUES (NULL,'$city_name', '$country_id')");

    header("Location: ".$_SERVER['HTTP_REFERER']);
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

  header("Location: ".$_SERVER['HTTP_REFERER']);
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
