<?php include 'config.php';

// $sql = "SELECT `Концерты`.`дата_время_начала` as `Дата и время начала`, `Группы`.`name` as `Группа`, `Тип_концерта`.`имя` as `Тип`, `Условия_выступления`.`имя` as `Условия выступления`, `Концерты`.`комментарий` as `Условия`, `Концерты`.`расходы` as `Расходы`, `Статус_переговоров`.`имя`as `Статус переговоров` \n"

//   . "FROM `Концерты`, `Тип_концерта`,`Условия_выступления`,`Группы`, `Статус_переговоров` \n"

//   . "WHERE `Концерты`.`группа`=`Группы`.`id` AND `Концерты`.`тип_концерта`=`Тип_концерта`.`id` AND `Концерты`.`условия`=`Условия_выступления`.`id` AND `Концерты`.`статус_переговоров`=`Статус_переговоров`.`id`";

$sql = "SELECT date(`дата_время_начала`) as `Дата`,  `Группы`.`name` as `Группа` from `Группы`, `Концерты` WHERE `Концерты`.`группа`=`Группы`.`id` and date(`дата_время_начала`) >= CURRENT_DATE";


$res_sql = mysqli_query($con, $sql);


$dir = 'img/афиши/';
// $f = scandir($dir);

$res_array = array();

while ($rows = mysqli_fetch_assoc($res_sql)) {
  $res_array[][] = $rows;
}


foreach ($res_array as $res) {
  foreach ($res as $result) {
    $date = $result['Дата'];
    $name = $result['Группа'];

  }
    echo "<div class=\"section-index__afisha flex\"><img class=\"section-index__afisha-img\" src=\"$dir$date.jpg\" alt=\"$name\"/></div>";
}

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
