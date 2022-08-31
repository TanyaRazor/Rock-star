<?php
header('Content-type: text/html; charset=utf-8');
session_start();
$TimeOutMinutes = 5; // This is your TimeOut period in minutes
$LogOff_URL = "login.php"; // If timed out, it will be redirected to this page

$TimeOutSeconds = $TimeOutMinutes * 60; // TimeOut in Seconds
if (isset($_SESSION['SessionStartTime'])) {
    $InActiveTime = time() - $_SESSION['SessionStartTime'];
    if ($InActiveTime >= $TimeOutSeconds) {
        session_destroy();
        header("Location: $LogOff_URL");
    }
}
$_SESSION['SessionStartTime'] = time();

if (! $_SESSION['admin']){
  header('Location: login.html');
}
?>


<!DOCTYPE html>
<html lang="ru">
  <?php include 'head.html';?>
<body>

    <div class="section-admin">
    <div class="container-fluid section-admin__container">

    </div>

    <a href="logout.php">Выйти</a>
      <?php include 'request.php';



    echo "<form action=\"request.php\" method=\"post\">
            <fieldset class=\"fieldset\">
              <legend>Добавление города</legend>
              <input class=\"input\" type=\"text\" name=\"city\" id=\"input_city\" placeholder=\"Введите город...\" onchange=\"toggleButton()\">
              <select name=\"countries\" id=\"countries\" class=\"section-admin__select-country\" onchange=\"toggleButton()\">
              <option value=\"NULL\" selected disabled hidden>Страна</option>";
              // <option value=\"NULL\" selected hidden>Страна</option>";
                foreach ($country_array as $countries) {
                  foreach ($countries as $result_countries) {
                    $country = $result_countries['имя'];
                  }
                  echo "<option value=\"$country\" class=\"section-admin__country-option\">$country</option>";
                }

              echo"</select>
              <input class=\"btn_concert add_city\" type=\"submit\" name=\"btn_city\" value=\"Добавить\" disabled>
              </fieldset>
          </form>

          <form action=\"request.php\" method=\"post\">
            <fieldset class=\"fieldset\">
              <legend>Добавление представителя</legend>
              <input class=\"input\" type=\"text\" id=\"agent\" name=\"agent\" placeholder=\"Ф. И. О.\" onchange=\"toggleButton()\">
              <input class=\"input\" type=\"tel\" name=\"phone\" id=\"phone\" placeholder=\"+71234567890\" onchange=\"toggleButton()\">

            <select name=\"cities\" id=\"cities\" class=\"section-admin__select-city\" onchange=\"toggleButton()\">
              <option value=\"NULL\" selected disabled hidden>Город</option>";

            foreach ($city_array as $cities) {
              foreach ($cities as $result_cities) {
                $city = $result_cities['имя'];
              }
              echo "<option value=\"$city\" class=\"section-admin__select-option\">$city</option>";
            }
            echo"</select>
            <input class=\"btn_concert add_agent\" type=\"submit\" name=\"btn_agents\" value=\"Добавить\" disabled>
            </fieldset>
        </form>

        <form action=\"request.php\" method=\"post\">
            <fieldset class=\"fieldset\">
              <legend>Добавление группы</legend>
              <input class=\"input\" type=\"text\" id=\"group\" name=\"group\" placeholder=\"Название группы\" onchange=\"toggleButton()\">
            <select name=\"agents\" id=\"agents\" class=\"section-admin__agents_name\" onchange=\"toggleButton()\">
              <option value=\"NULL\" selected disabled hidden>Представитель</option>";

            foreach ($director_array as $ag) {
              foreach ($ag as $agents) {
                $agent = $agents['Имя'];
              }
              echo "<option value=\"$agent\" class=\"section-admin__select-option\">$agent</option>";
            }
            echo"</select>
            <select name=\"genre\" id=\"genre\" class=\"section-admin__genre_name\" onchange=\"toggleButton()\">
              <option value=\"NULL\" selected disabled hidden>Жанр</option>";

            foreach ($genre_array as $gen) {
              foreach ($gen as $genres) {
                $genre = $genres['имя'];
              }
              echo "<option value=\"$genre\" class=\"section-admin__select-option\">$genre</option>";
            }
            echo"</select>
            <input class=\"btn_concert add_group\" type=\"submit\" name=\"btn_groups\" value=\"Добавить\" disabled>
            </fieldset>
        </form>

      <form action=\"request.php\" method=\"post\">
        <fieldset class=\"fieldset flex\">
          <legend>Добавление мероприятий</legend>
          <div class=\"all_input\">
            <div class=\"input\">
              <label class=\"input__label flex\" for=\"#date\">Дата мероприятия
                <input class=\"input\" type=\"datetime-local\" name=\"date\" id=\"date\" onchange=\"toggleButton()\">
              </label>
            </div>

            <div class=\"input\">
              <label class=\"input__label flex\" for=\"#groups\">Группа
                <select name=\"groups\" id=\"groups_select\" onchange=\"toggleButton()\">
                <option value=\"NULL\" selected disabled hidden>Группа</option>";

                foreach ($group_array as $gr) {
                  foreach ($gr as $group) {
                    $group_name = $group['name'];
                  }
                  echo "<option value=\"$group_name\">$group_name</option>";
                }
          echo "</select>
              </label>
            </div>

            <div class=\"input\">
              <label class=\"input__label flex\" for=\"#type_concert\">Тип концерта
                <select name=\"type_concert\" id=\"type_concert\" onchange=\"toggleButton()\">
                  <option value=\"NULL\" selected disabled hidden>Тип концерта</option>";
                  foreach ($type_concert_array as $t) {
                    foreach ($t as $type) {
                      $type_concert = $type['имя'];
                    }
                    echo "<option value=\"$type_concert\">$type_concert</option>";
                  }
          echo "</select>
              </label>
            </div>

            <div class=\"input\">
              <label class=\"input__label flex\" for=\"#conditions\">Условия
                <select name=\"conditions\" id=\"conditions\"\ onchange=\"toggleButton()\">
                  <option value=\"NULL\" selected disabled hidden>Условия</option>";
                  foreach ($conditions_array as $c) {
                    foreach ($c as $condition) {
                      $condition_name = $condition['имя'];
                    }
                    echo "<option value=\"$condition_name\">$condition_name</option>";
                  }
            echo "</select>
              </label>
            </div>

            <div class=\"input\">
              <label class=\"input__label flex\" for=\"#comments\">Комментарий
                <input class=\"input\" type=\"text\" name=\"comments\" id=\"comments\" placeholder=\"Комментарий...\">
              </label>
            </div>

            <div class=\"input\">
              <label class=\"input__label flex\" for=\"#costs\">Расходы
                <input type=\"checkbox\" name=\"costs\" id=\"costs\">
              </label>
            </div>

            <div class=\"input\">
              <label class=\"input__label flex\" for=\"#status\">Статус переговоров
                <select class=\"input\" name=\"status\" id=\"status\" onchange=\"toggleButton()\">
                  <option value=\"NULL\" selected disabled hidden>Статус переговоров</option>";
                  foreach ($status_array as $st) {
                    foreach ($st as $status) {
                      $status_name = $status['имя'];
                    }
                    echo "<option value=\"$status_name\">$status_name</option>";
                  }?>

                </select>
              </label>
            </div>
            <input class="btn_concert add_concert" type="submit" name="add_concert" value="Добавить" disabled>
          </div>
        </fieldset>
      </form>



        <?php include 'request.php';

        echo "<fieldset class=\"fieldset table-responsive\">
              <legend>Мероприятия</legend>
                <table class=\"table\">
                <tr>
                  <th>Дата</th>
                  <th>Группа</th>
                  <th>Тип концерта</th>
                  <th>Условия</th>
                  <th>Комментарий</th>
                  <th>Расходы</th>
                  <th>Статус переговоров</th>
                </tr>";

                foreach ($concerts_array as $c) {
                  foreach ($c as $concert) {
                      $id = $concert['id'];
                      $data = $concert['Дата'];
                      $groups = $concert['Группа'];
                      $type_concert = $concert['Тип'];
                      $conditions = $concert['Условия выступления'];
                      $comments = $concert['Комментарий'];
                      $cost = $concert['Расходы'];
                      $status = $concert['Статус переговоров'];
                  }
                  echo "<tr>
                          <td>$data</td>
                          <td>$groups</td>
                          <td>$type_concert</td>
                          <td>$conditions</td>
                          <td>$comments</td>
                          <td>$cost</td>
                          <td>$status</td>
                          <td class=\"btn_edit\">
                            <a href=\"/edit.php/?edit_id=$id\">
                            <svg class=\"edit_icon\" width=\"16\" height=\"16\" viewBox=\"0 0 16 16\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
<path d=\"M12.8536 0.146447C12.6583 -0.0488155 12.3417 -0.0488155 12.1465 0.146447L10.5 1.7929L14.2071 5.50001L15.8536 3.85355C16.0488 3.65829 16.0488 3.34171 15.8536 3.14645L12.8536 0.146447Z\" fill=\"black\"/>
<path d=\"M13.5 6.20711L9.7929 2.50001L3.29291 9H3.5C3.77614 9 4 9.22386 4 9.5V10H4.5C4.77614 10 5 10.2239 5 10.5V11H5.5C5.77614 11 6 11.2239 6 11.5V12H6.5C6.77614 12 7 12.2239 7 12.5V12.7071L13.5 6.20711Z\" fill=\"black\"/>
<path d=\"M6.03166 13.6755C6.01119 13.6209 6 13.5617 6 13.5V13H5.5C5.22386 13 5 12.7761 5 12.5V12H4.5C4.22386 12 4 11.7761 4 11.5V11H3.5C3.22386 11 3 10.7761 3 10.5V10H2.5C2.43827 10 2.37915 9.98881 2.32455 9.96835L2.14646 10.1464C2.09858 10.1943 2.06092 10.2514 2.03578 10.3143L0.0357762 15.3143C-0.0385071 15.5 0.00502989 15.7121 0.146461 15.8536C0.287892 15.995 0.500001 16.0385 0.68571 15.9642L5.68571 13.9642C5.74858 13.9391 5.80569 13.9014 5.85357 13.8536L6.03166 13.6755Z\" fill=\"black\"/>
</svg></a>
                          </td>
                          <td class=\"btn_delete\">
                            <a href=\"/request.php?delete_id=$id\">
                            <svg class=\"delete_icon\" width=\"16\" height=\"16\" viewBox=\"0 0 16 16\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
<path d=\"M2.5 1C1.94772 1 1.5 1.44772 1.5 2V3C1.5 3.55228 1.94772 4 2.5 4H3V13C3 14.1046 3.89543 15 5 15H11C12.1046 15 13 14.1046 13 13V4H13.5C14.0523 4 14.5 3.55228 14.5 3V2C14.5 1.44772 14.0523 1 13.5 1H10C10 0.447715 9.55229 0 9 0H7C6.44772 0 6 0.447715 6 1H2.5ZM5.5 5C5.77614 5 6 5.22386 6 5.5V12.5C6 12.7761 5.77614 13 5.5 13C5.22386 13 5 12.7761 5 12.5L5 5.5C5 5.22386 5.22386 5 5.5 5ZM8 5C8.27614 5 8.5 5.22386 8.5 5.5V12.5C8.5 12.7761 8.27614 13 8 13C7.72386 13 7.5 12.7761 7.5 12.5V5.5C7.5 5.22386 7.72386 5 8 5ZM11 5.5V12.5C11 12.7761 10.7761 13 10.5 13C10.2239 13 10 12.7761 10 12.5V5.5C10 5.22386 10.2239 5 10.5 5C10.7761 5 11 5.22386 11 5.5Z\" fill=\"black\"/>
</svg></a>
                        </td>
                      </tr>";

                }
          ?>
          </tbody>
        </table>
      </fieldset>
</body>
</html>
