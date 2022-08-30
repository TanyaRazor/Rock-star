<!DOCTYPE html>
<html lang="ru">

  <?php include 'head.html';?>

</head>
<body>

<div>
        <input class="inputStandard" type="button" onclick="history.back();" value="Назад"/>
    </div>

<?php include 'request.php';

$id = $_GET['edit_id'];

// echo $id;

$sql_edit = mysqli_query($con, "SELECT `Концерты`.`id` as `id`, `Концерты`.`дата_время_начала` as `Дата`, `Группы`.`name` as `Группа`, `Тип_концерта`.`имя` as `Тип`, `Условия_выступления`.`имя` as `Условия выступления`, `Концерты`.`комментарий` as `Комментарий`, `Концерты`.`расходы` as `Расходы`, `Статус_переговоров`.`имя`as `Статус переговоров` FROM `Концерты`, `Тип_концерта`,`Условия_выступления`,`Группы`, `Статус_переговоров` WHERE `Концерты`.`группа`=`Группы`.`id` AND `Концерты`.`тип_концерта`=`Тип_концерта`.`id` AND `Концерты`.`условия`=`Условия_выступления`.`id` AND `Концерты`.`статус_переговоров`=`Статус_переговоров`.`id` AND `Концерты`.`id` = \"$id\"");

// $res = mysqli_fetch_assoc($sql_edit);

      echo "<form action=\"request.php\" method=\"post\">
      <fieldset class=\"fielset-edit\">
      <legend>Редактирование мероприятия</legend>
      <div class=\"all_input-edit\">
      <div class=\"input_edit\">
          <label class=\"input__label flex\" for=\"#id_edit\">Id
          <input type=\"text\" name=\"id_edit\" id=\"id_edit\" value=\"$id\" readonly=\"readonly\">";

          // foreach($sql_edit as $ed){
          //   $id_edit = $ed['id'];
          //   echo "<input type=\"text\" name=\"id_edit\" id=\"id_edit\" value=\"$id_edit\" readonly=\"readonly\">";
          // }
          echo"</label>
        </div>
        <div class=\"input_edit\">
          <label class=\"input__label flex\" for=\"#date_edit\">Дата мероприятия";
          foreach($sql_edit as $ed){
            $data_edit = $ed['Дата'];
            echo "<input type=\"datetime-local\" name=\"date_edit\" id=\"date_edit\" value=\"$data_edit\">";
          }
          echo"</label>
        </div>

        <div class=\"input_edit\">
          <label class=\"input__label flex\" for=\"#group_edit\">Группа
            <select name=\"group_edit\" id=\"group_edit\">";
            foreach($sql_edit as $ed){
              $group_edit = $ed['Группа'];
            }

            foreach ($group_array as $gr) {
              foreach ($gr as $group) {
                $group_name = $group['name'];
              }

              echo "<option value=\"$group_name\"";
              if ($group_name == $group_edit){
                echo "selected";
              }
              echo">$group_name</option>";
            }
      echo "</select>
          </label>
        </div>

        <div class=\"input_edit\">
          <label class=\"input__label flex\" for=\"#type_concert_edit\">Тип концерта
            <select name=\"type_concert_edit\" id=\"type_concert_edit\">";
              foreach($sql_edit as $ed){
                $type_edit = $ed['Тип'];
              }

              foreach ($type_concert_array as $t) {
                foreach ($t as $type) {
                  $type_concert = $type['имя'];
                }
                echo "<option value=\"$type_concert\"";
                if ($type_concert == $type_edit){
                  echo "selected";
                }
                echo">$type_concert</option>";
              }

      echo "</select>
          </label>
        </div>

        <div class=\"input_edit\">
          <label class=\"input__label flex\" for=\"#conditions_edit\">Условия
            <select name=\"condition_edit\" id=\"condition_edit\"\>";

            foreach($sql_edit as $ed){
              $condition_edit = $ed['Условия выступления'];
            }

            foreach ($conditions_array as $c) {
              foreach ($c as $condition) {
                $condition_name = $condition['имя'];
              }
              echo "<option value=\"$condition_name\"";
              if ($condition_name == $condition_edit){
                echo "selected";
              }
              echo">$condition_name</option>";
            }

        echo "</select>
          </label>
        </div>

        <div class=\"input_edit\">
          <label class=\"input__label flex\" for=\"#comments_edit\">Комментарий";

          foreach($sql_edit as $ed){
            $comment_edit = $ed['Комментарий'];
          }
            echo"<input type=\"text\" name=\"comments_edit\" id=\"comments_edit\" value=\"$comment_edit\" placeholder=\"Комментарий...\">
          </label>
        </div>

        <div class=\"input_edit\">
          <label class=\"input__label flex\" for=\"#costs_edit\">Расходы";

          if($ed['Расходы'] == 1){
            echo "<input type=\"checkbox\" name=\"costs_edit\" id=\"costs_edit\" checked>";
          }else{
            echo "<input type=\"checkbox\" name=\"costs_edit\" id=\"costs_edit\">";
          }

          echo "</label>
        </div>

        <div class=\"input_edit\">
          <label class=\"input__label flex\" for=\"#status_edit\">Статус переговоров
            <select name=\"status_edit\" id=\"status_edit\">";

            foreach($sql_edit as $ed){
              $status_edit = $ed['Статус переговоров'];
            }

            foreach ($status_array as $st) {
              foreach ($st as $status) {
                $status_name = $status['имя'];
              }
              echo "<option value=\"$status_name\"";
              if ($status_name == $status_edit){
                echo "selected";
              }
              echo">$status_name</option>";
            }
              ?>

            </select>
          </label>
        </div>
      </div>
      <input class="btn_concert" type="submit" name="edit_concert" value="Сохранить">
    </fieldset>
  </form>

  </body>
  </html>