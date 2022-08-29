<!DOCTYPE html>
<html lang="ru">
  <?php include 'head.html';?>
<body>

    <div class="section-admin">
    <div class="container-fluid section-admin__container">

      <?php include 'request.php';

            echo "<form action=\"request.php\" method=\"post\">
              <input type=\"text\" name=\"city\" placeholder=\"Введите город...\">
              <select name=\"countries\" id=\"countries\" class=\"section-admin__select-country\">";
                foreach ($country_array as $countries) {
                  foreach ($countries as $result_countries) {
                    $country = $result_countries['имя'];
                  }
                  echo "<option value=\"$country\" class=\"section-admin__country-option\">$country</option>";
                }

              echo"</select>
              <input type=\"submit\" name=\"btn_city\" value=\"Добавить\">
            </form>";

            echo "<select name=\"cities\" id=\"cities\" class=\"section-admin__select-city\">
            <option value=\"\" selected disabled hidden>Город</option>";

            foreach ($city_array as $cities) {
              foreach ($cities as $result_cities) {
                $city = $result_cities['имя'];
              }
              echo "<option value=\"$city\" class=\"section-admin__select-option\">$city</option>";
            }
            echo "</select>";

echo "<form action=\"request.php\" method=\"post\">
        <fieldset class=\"fielset flex\">
          <legend>Добавление мероприятий</legend>
          <div class=\"all_input\">
            <div class=\"input\">
              <label class=\"input__label flex\" for=\"#date\">Дата мероприятия
                <input type=\"datetime-local\" name=\"date\" id=\"date\">
              </label>
            </div>

            <div class=\"input\">
              <label class=\"input__label flex\" for=\"#groups\">Группа
                <select name=\"groups\" id=\"groups\">
                <option value=\"\" selected disabled hidden>Группа</option>";

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
                <select name=\"type_concert\" id=\"type_concert\">
                  <option value=\"\" selected disabled hidden>Тип концерта</option>";
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
                <select name=\"conditions\" id=\"conditions\"\>
                  <option value=\"\" selected disabled hidden>Условия</option>";
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
                <input type=\"text\" name=\"comments\" id=\"comments\" placeholder=\"Комментарий...\">
              </label>
            </div>

            <div class=\"input\">
              <label class=\"input__label flex\" for=\"#costs\">Расходы
                <input type=\"checkbox\" name=\"costs\" id=\"costs\">
              </label>
            </div>

            <div class=\"input\">
              <label class=\"input__label flex\" for=\"#status\">Статус переговоров
                <select name=\"status\" id=\"status\">
                  <option value=\"\" selected disabled hidden>Статус переговоров</option>";
                  foreach ($status_array as $st) {
                    foreach ($st as $status) {
                      $status_name = $status['имя'];
                    }
                    echo "<option value=\"$status_name\">$status_name</option>";
                  }?>

                </select>
              </label>
            </div>
          </div>
          <input class="btn_add_concert" type="submit" name="add_concert" value="Отправить">
        </fieldset>
      </form>

<?php include 'request.php';
while ($rows = mysqli_fetch_assoc($sql7)) {
  // echo $rows;
  // $concerts_array[] = $rows;


  foreach ($rows as $c => $concert) {
    // foreach ($concert as $c){

      echo "$concert ";
    // }
  }
  echo "<br>";
  }
?>

</body>
</html>
