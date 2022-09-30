<?php

include_once 'config.php';
include_once 'paginator.php';

// $sql = "SELECT `Концерты`.`дата_время_начала` as `Дата и время начала`, `Группы`.`name` as `Группа`, `Тип_концерта`.`имя` as `Тип`, `Условия_выступления`.`имя` as `Условия выступления`, `Концерты`.`комментарий` as `Условия`, `Концерты`.`расходы` as `Расходы`, `Статус_переговоров`.`имя`as `Статус переговоров`
//   . "FROM `Концерты`, `Тип_концерта`,`Условия_выступления`,`Группы`, `Статус_переговоров`
//   . "WHERE `Концерты`.`группа`=`Группы`.`id` AND `Концерты`.`тип_концерта`=`Тип_концерта`.`id` AND `Концерты`.`условия`=`Условия_выступления`.`id` AND `Концерты`.`статус_переговоров`=`Статус_переговоров`.`id`";

// $sql_concerts = "SELECT `Концерты`.`дата_время_начала` as `Дата и время начала`, `Группы`.`name` as `Группа`, `Тип_концерта`.`имя` as `Тип`, `Условия_выступления`.`имя` as `Условия выступления`, `Концерты`.`комментарий` as `Условия`, `Концерты`.`расходы` as `Расходы`, `Статус_переговоров`.`имя`as `Статус переговоров`";

$sql = mysqli_query($con, "SELECT id, DATE_FORMAT(`дата_время_начала`, '%d.%m.%Y %H:%i') as `Дата и время`, date(`дата_время_начала`) as `Дата`, `название` as `Название`, `группы` as `Группы`, `афиша` as `Афиша` from `Концерты` WHERE date(`дата_время_начала`) >= CURRENT_DATE ORDER BY `Дата` ASC");

$sql_post = mysqli_query($con, "SELECT DATE(`Концерты`.`дата_время_начала`) as `Дата`, `Посты`.`id` as `id`, `Концерты`.`название` as `Концерт`, `Посты`.`текст` as `Описание` FROM `Концерты`, `Посты` WHERE `Посты`.`id_концерта`=`Концерты`.`id` ORDER BY `Концерты`.`дата_время_начала` DESC");

$sql1 = mysqli_query($con, "SELECT * FROM `Город` ORDER BY `имя`");

$sql2 = mysqli_query($con, "SELECT * FROM `Страна` ORDER BY `имя`");

$sql3 = mysqli_query($con,"SELECT `Группы`.`id` as `id`, `Группы`.`name` as `Имя`, `Представитель`.`имя` as `Представитель`, `Жанр_группы`.`имя` as `Жанр` FROM `Представитель`, `Группы`, `Жанр_группы` WHERE `Группы`.`id_agent`=`Представитель`.`id` AND `Группы`.`id_жанра`=`Жанр_группы`.`id` ORDER BY `Группы`.`name` ASC");

$sql4 = mysqli_query($con, "SELECT * FROM `Тип_концерта`");

$sql5 = mysqli_query($con, "SELECT * FROM `Условия_выступления`");

$sql6 = mysqli_query($con, "SELECT * FROM `Статус_переговоров` ORDER BY `id`");

$sql7 = mysqli_query($con, "SELECT `Концерты`.`id` as `id`, `Концерты`.`дата_время_начала` as `Дата`,  `название` as `Название`, `группы` as `Группы`, `Тип_концерта`.`имя` as `Тип`, `Условия_выступления`.`имя` as `Условия выступления`, `Концерты`.`комментарий` as `Комментарий`, `Концерты`.`расходы` as `Расходы`, `Статус_переговоров`.`имя`as `Статус переговоров`, `Концерты`.`афиша` as `Афиша` FROM `Концерты`, `Тип_концерта`,`Условия_выступления`, `Статус_переговоров` WHERE `Концерты`.`тип_концерта`=`Тип_концерта`.`id` AND `Концерты`.`условия`=`Условия_выступления`.`id` AND `Концерты`.`статус_переговоров`=`Статус_переговоров`.`id` ORDER BY `Дата` DESC");

$sql8 = mysqli_query($con, "SELECT `Представитель`.`id` as `id`, `Представитель`.`имя` as `Имя`, `Представитель`.`телефон` as `Телефон`, `Город`.`имя` AS `Город` FROM `Представитель`, `Город` WHERE `Город`.`id` = `Представитель`.`id_города` ORDER BY `Представитель`.`имя` ASC");


$sql9 = mysqli_query($con, "SELECT * FROM `Жанр_группы`");

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
$new_array = array();
$archive_array = array();
$posts_array = array();

if (isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = 1;
}
$limit = 5;
$offset = !empty($page)?(($page-1)*$limit):0;
 //получаем количество записей
$count_new_events = mysqli_query($con, "SELECT COUNT(id) as `Количество` from `Концерты` WHERE date(`дата_время_начала`) >= CURRENT_DATE");
$count_archive_events = mysqli_query($con, "SELECT COUNT(id) as `Количество` from `Концерты` WHERE date(`дата_время_начала`) < CURRENT_DATE");

foreach($count_new_events as $resultNum){
  $rowNewCount = $resultNum['Количество'];
}
foreach($count_archive_events as $resultNum){
  $rowArchiveCount = $resultNum['Количество'];
}

$limit_page_new = ceil($rowNewCount / $limit);
$limit_page_old = ceil($rowArchiveCount / $limit);

//инициализируем класс pagination
// $pagNewConfig = array(
//      'baseURL'=>'https://rockstar57.ru/events.php',
//      'totalRows'=>$rowNewCount,
//      'perPage'=>$limit
//  );
// $pagArchiveConfig = array(
//      'baseURL'=>'https://rockstar57.ru/events.php',
//      'totalRows'=>$rowArchiveCount,
//      'perPage'=>$limit
//  );

// $paginationNew =  new Pagination($pagNewConfig);
// $paginationOld =  new Pagination($pagArchiveConfig);

$new_concerts = mysqli_query($con, "SELECT id, DATE_FORMAT(`дата_время_начала`, '%d.%m.%Y %H:%i') as `Дата`, date(`дата_время_начала`) as `Дата2`, `название` as `Название`, `группы` as `Группы`, `афиша` as `Афиша` from `Концерты` WHERE date(`дата_время_начала`) >= CURRENT_DATE ORDER BY `Дата2` ASC LIMIT $offset,$limit");

$archive_concerts = mysqli_query($con, "SELECT id, DATE_FORMAT(`дата_время_начала`, '%d.%m.%Y %H:%i') as `Дата`, date(`дата_время_начала`) as `Дата2`, `название` as `Название`, `группы` as `Группы`, `афиша` as `Афиша` from `Концерты` WHERE date(`дата_время_начала`) < CURRENT_DATE ORDER BY `Дата2` DESC LIMIT $offset,$limit");



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
while ($rows = mysqli_fetch_assoc($sql_post)) {
  $posts_array[][] = $rows;
}
while ($rows = mysqli_fetch_assoc($new_concerts)) {
  $new_array[][] = $rows;
}
while ($rows = mysqli_fetch_assoc($archive_concerts)) {
  $archive_array[][] = $rows;
}




if (isset($_POST['btn_city'])) {
    $city_name = $con->real_escape_string($_POST['city']);
    $country_name = $con->real_escape_string($_POST['countries']);

    $country_id = mysqli_query($con, "SELECT `id` FROM `Страна` WHERE `имя`=\"$country_name\"");

    foreach ($country_id as $c_id){
      $country_id = $c_id['id'];
    }

    $city_add = mysqli_query($con, "INSERT INTO `Город` (`id`,`имя`, `id_страны`) VALUES (NULL,'$city_name', '$country_id')");

    if ($city_add) {
      header("Refresh: 1;" ."/admin.php");
      exit;
    } else {
      header("Refresh: 1;" ."/admin.php");
      exit;
    }
}

if (isset($_POST['btn_agents'])) {
  $agent_name = $con->real_escape_string($_POST['agent']);
  $phone = $con->real_escape_string($_POST['phone']);
  $city_name = $con->real_escape_string($_POST['cities']);

  $city_id = mysqli_query($con, "SELECT `id` FROM `Город` WHERE `имя`=\"$city_name\"");

  foreach ($city_id as $c_id){
    $city_id = $c_id['id'];
  }

  $agent_add = mysqli_query($con, "INSERT INTO `Представитель` (`id`,`имя`, `телефон`, `id_города`) VALUES (NULL, '$agent_name', '$phone' ,'$city_id')");

  if ($agent_add) {
    header("Refresh: 1;" ."/admin.php");
    exit;
  } else {
    header("Refresh: 1;" ."/admin.php");
    exit;
  }
}

if (isset($_POST['btn_groups'])) {
  $group_name = $con->real_escape_string($_POST['group']);
  $agent_name = $con->real_escape_string($_POST['agents']);

  $agent_id = mysqli_query($con, "SELECT `id` FROM `Представитель` WHERE `имя`=\"$agent_name\"");
  foreach ($agent_id as $a_id){
    $agent_id = $a_id['id'];
  }

  // if ($_POST['genres'] == "noname"){
  //   $genre_id = '0';
  // }else{
    $genre_name = $con->real_escape_string($_POST['genres']);
    $genre_id = mysqli_query($con, "SELECT `id` FROM `Жанр_группы` WHERE `имя`=\"$genre_name\"");
  // }

  foreach ($genre_id as $g_id){
    $genre_id = $g_id['id'];
  }


  $group_add = mysqli_query($con, "INSERT INTO `Группы` (`id`,`name`, `id_agent`,`id_жанра`) VALUES (NULL,\"$group_name\",\"$agent_id\",\"$genre_id\")");

  if ($group_add) {
    header("Refresh: 1;" ."/admin.php");
    exit;
  } else {
    header("Refresh: 1;" ."/admin.php");
    exit;
  }
}

if (isset($_POST['btn_post'])) {
  $consert_name = $con->real_escape_string($_POST['concerts_name']);
  $post_descr = $con->real_escape_string($_POST['post']);

  $concerts_id = mysqli_query($con, "SELECT `id` FROM `Концерты` WHERE `название`=\"$consert_name\"");
  foreach ($concerts_id as $c_id){
    $concert_id = $c_id['id'];
  }

  $post_add = mysqli_query($con, "INSERT INTO `Посты` (`id`,`id_концерта`, `текст`) VALUES (NULL,\"$concert_id\",\"$post_descr\")");

  if ($post_add) {
    header("Refresh: 1;" ."/admin.php");
    exit;
  } else {
    header("Refresh: 1;" ."/admin.php");
    exit;
  }
}



if (isset($_POST['add_concert'])) {

  $date = $con->real_escape_string($_POST['date']);
  $name = $con->real_escape_string($_POST['name_activity']);
  $group_name_array = array();
  $group_name = $_POST['groups'];

  if ($group_name){
    foreach ($group_name as $group){
      array_push($group_name_array, $group);
    }
  }

  $groups_name = $con->real_escape_string(implode(",", $group_name_array));

  $type_name = $con->real_escape_string($_POST['type_concert']);
  $condition_name = $con->real_escape_string($_POST['conditions']);
  $status_name = $con->real_escape_string($_POST['status']);


  // $group_id = mysqli_query($con, "SELECT * FROM `Группы` WHERE `name` = \"$group_name\"");
  $type_id = mysqli_query($con, "SELECT * FROM `Тип_концерта` WHERE `имя` = \"$type_name\"");
  $condition_id = mysqli_query($con, "SELECT * FROM `Условия_выступления` WHERE `имя` = \"$condition_name\"");
  $status_id = mysqli_query($con, "SELECT * FROM `Статус_переговоров` WHERE `имя` = \"$status_name\"");

  // foreach ($group_id as $g){
  //   $group_id = $g['id'];
  // }
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

  $src_poster = $_FILES['image']['tmp_name'];
  if ($src_poster){

    $fileTmpName = $_FILES['image']['tmp_name'];
    $errorCode = $_FILES['image']['error'];
    // Проверим на ошибки
    if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($fileTmpName)) {
        // Массив с названиями ошибок
        $errorMessages = [
          UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
          UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
          UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
          UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
          UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
          UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
          UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
        ];
        // Зададим неизвестную ошибку
        $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
        // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
        $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
        // Выведем название ошибки
        die($outputMessage);
    } else {
        // Создадим ресурс FileInfo
        $fi = finfo_open(FILEINFO_MIME_TYPE);
        // Получим MIME-тип
        $mime = (string) finfo_file($fi, $fileTmpName);
        // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
        if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');

        // Результат функции запишем в переменную
        $image = getimagesize($fileTmpName);

        // Зададим ограничения для картинок
        $limitBytes  = 1024 * 1024 * 5;

        // Проверим нужные параметры
        if (filesize($fileTmpName) > $limitBytes) die('Размер изображения не должен превышать 5 Мбайт.');

            // Сгенерируем расширение файла на основе типа картинки
          $extension = image_type_to_extension($image[2]);

          // Сократим .jpeg до .jpg
          $format = str_replace('jpeg', 'jpg', $extension);

          $date_poster = date('Y-m-d',strtotime($date));
          $name_poster = $date_poster . "_" . $name . $format;

        // Переместим картинку с новым именем и расширением в папку
        if (!move_uploaded_file($fileTmpName, __DIR__ . "/img/афиши/" . $name_poster)) {
            die('При записи изображения на диск произошла ошибка.');
        }
      }
    }else{
      $name_poster = "";

    }
    $concert_add =  mysqli_query($con, "INSERT INTO `Концерты` (`id`, `дата_время_начала`,`название`,`группы`, `тип_концерта`, `условия`,`комментарий`,`расходы`,`статус_переговоров`, `афиша`) VALUES (NULL, \"$date\", \"$name\",\"$groups_name\", \"$type_id\", \"$condition_id\", \"$comment\", \"$costs\", \"$status_id\", \"$name_poster\")");

  if ($concert_add) {
    header("Refresh: 1;" ."/admin.php");
    exit;
  } else {
    header("Refresh: 1;" ."/admin.php");
    exit;
  }
}

if (isset($_POST['btn_edit'])) {
  $name_tab = $_POST['name_edit_tab'];
  $id =$_POST['id_edit'];
  switch ($name_tab){
    case "agents":
      $name = $con->real_escape_string($_POST['name_edit']);
      $phone = $con->real_escape_string($_POST['phone_edit']);
      $city = $con->real_escape_string($_POST['cities_edit']);
      $city_id = mysqli_query($con, "SELECT `id` FROM `Город` WHERE `имя`=\"$city\"");

      foreach ($city_id as $c_id){
        $city_id = $c_id['id'];
      }
      $sql = mysqli_query($con, "UPDATE `Представитель` SET `имя`='$name', `телефон` = '$phone', `id_города`='$city_id' WHERE `Представитель`.`id` = '$id'");
      break;

    case "groups":
      $name = $con->real_escape_string($_POST['name_edit']);
      $agent = $con->real_escape_string($_POST['agents_edit']);
      $genre = $con->real_escape_string($_POST['genres_edit']);
      $agent_id = mysqli_query($con, "SELECT `id` FROM `Представитель` WHERE `имя`=\"$agent\"");
      $genre_id = mysqli_query($con, "SELECT `id` FROM `Жанр_группы` WHERE `имя`=\"$genre\"");

      foreach ($agent_id as $a_id){
        $agent_id = $a_id['id'];
      }
      foreach ($genre_id as $g_id){
        $genre_id = $g_id['id'];
      }
      $sql = mysqli_query($con, "UPDATE `Группы` SET `name`='$name', `id_agent` = '$agent_id', `id_жанра`='$genre_id' WHERE `Группы`.`id` = '$id'");
      break;

    case "events":
      $date = $con->real_escape_string($_POST['date_edit']);
      $name = $con->real_escape_string($_POST['name_edit']);
      $group_name_array = array();
      $group_name = $_POST['group_edit'];

      if ($group_name){
        foreach ($group_name as $group){
          array_push($group_name_array, $group);
        }
      }

      $groups_name = $con->real_escape_string(implode(",", $group_name_array));
      $type_name = $con->real_escape_string($_POST['type_concert_edit']);
      $condition_name = $con->real_escape_string($_POST['condition_edit']);
      $comment_edit = $con->real_escape_string($_POST['comments_edit']);
      $status_name = $con->real_escape_string($_POST['status_edit']);
      $type_id = mysqli_query($con, "SELECT * FROM `Тип_концерта` WHERE `имя` = \"$type_name\"");
      $condition_id = mysqli_query($con, "SELECT * FROM `Условия_выступления` WHERE `имя` = \"$condition_name\"");
      $status_id = mysqli_query($con, "SELECT * FROM `Статус_переговоров` WHERE `имя` = \"$status_name\"");
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
      $src_poster = $_FILES['load_image_edit']['tmp_name'];
      if ($src_poster){
        $fileTmpNameEdit = $_FILES['load_image_edit']['tmp_name'];
        $errorCode = $_FILES['load_image_edit']['error'];
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($fileTmpNameEdit)) {
          $errorMessages = [
            UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
            UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
            UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
            UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
            UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
            UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
            UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
            ];
            $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
            die($outputMessage);
        } else {
          $fi = finfo_open(FILEINFO_MIME_TYPE);
          $mime = (string) finfo_file($fi, $fileTmpNameEdit);
          if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');
          $image = getimagesize($fileTmpNameEdit);
          $limitBytes  = 1024 * 1024 * 5;
          if (filesize($fileTmpNameEdit) > $limitBytes) die('Размер изображения не должен превышать 5 Мбайт.');
          $extension = image_type_to_extension($image[2]);
          $format = str_replace('jpeg', 'jpg', $extension);
          $date_poster = date('Y-m-d',strtotime($date));
          $poster_edit = $date_poster . "_" . $name . $format;
          if (!move_uploaded_file($fileTmpNameEdit, __DIR__ . "/img/афиши/" . $poster_edit)) {
            die('При записи изображения на диск произошла ошибка.');
          }
        }
      }else{
        $poster_edit = $con->real_escape_string($_POST['poster_img_edit']);
      }
      $sql = mysqli_query($con, "UPDATE `Концерты` SET `дата_время_начала`='$date', `Название` = '$name', `группы`='$groups_name', `тип_концерта`='$type_id', `условия`='$condition_id', `комментарий`='$comment_edit', `расходы`='$costs_edit', `статус_переговоров`='$status_id', `афиша`='$poster_edit' WHERE `Концерты`.`id` = '$id'");
      break;

    case "posts":
      $post = $con->real_escape_string($_POST['post_edit']);
      $sql = mysqli_query($con, "UPDATE `Посты` SET `текст` = '$post' WHERE `Посты`.`id` = '$id'");
      break;
  }

    if ($sql) {
      header("Refresh: 1;" ."/admin.php");
    exit;
  } else {
    header("Refresh: 1;" ."/admin.php");
    exit;
  }
}


if (isset($_GET['delete_id'])) {
  $name = $_GET['name'];
  $id = $_GET['delete_id'];
  switch ($name){
    case "agents":
      $sql_delete = mysqli_query($con, "DELETE FROM `Представитель` WHERE `ID` = '$id'");
      break;
    case "groups":
      $sql_delete = mysqli_query($con, "DELETE FROM `Группы` WHERE `ID` = '$id'");
      break;
    case "concerts":
      $sql = mysqli_query($con, "SELECT `афиша` FROM `Концерты` WHERE `ID` = '$id'");
      foreach ($sql as $file){
        $filepath = __DIR__ . "/img/афиши/" . $file['афиша'];
      }
      unlink($filepath);
      $sql_delete = mysqli_query($con, "DELETE FROM `Концерты` WHERE `ID` = '$id'");
      break;
    case "posts":
      $sql_delete = mysqli_query($con, "DELETE FROM `Посты` WHERE `ID` = '$id'");
      break;
    }
  if ($sql_delete) {
    header("Refresh: 1;" ."/admin.php");
    exit;
  } else {
    header("Refresh: 1;" ."/admin.php");
    exit;
  }
}

if (isset($_POST['btn_ref'])){
  $sql = mysqli_query($con, "UPDATE `Концерты` SET `статус_переговоров` = 4 WHERE `статус_переговоров` < 4 AND `дата_время_начала` < CURRENT_DATE");

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