<!DOCTYPE html>
<html lang="ru">

<?php include 'head.html';?>

<body>

<?php include 'header.html';?>
<main id="index">
  <div class="section-index">
    <div class="container-fluid section-index__container">

        <div id="myModal" class="modal_img">
        <!-- The Close Button -->
        <!-- <span class="close">&times;</span> -->
        <!-- Modal Content (The Image) -->
        <img class="modal-content_img" id="img01" src="" alt="">
        <!-- Modal Caption (Image Text) -->
        <!-- <div id="caption"></div> -->
        </div>

      <h2 class="header section-index__header">Главная</h2>
      <div class="section-index__content flex">
        <div class="section-index__one">
          <p class="section-index__content-p">
            Дорогой друг!!!
          </p>
          <p class="section-index__content-p">
            Тебя приветствует самый безбашенный караоке бар Черноземья.
          </p>
          <p class="section-index__content-p">
            Хочешь прекрасно провести вечер в замечательной атмосфере рок-бара под хорошую музыку (директор Брянского отделения бара Алексей Симон Симоненко: "Чем мы отличаемся от обычного караоке бара? В обычном караоке-баре люди плохо поют плохие песни, а в нашем баре плохо поют, но хорошие песни.")?
          </p>
          <p class="section-index__content-p">
            Мы работаем для вас ежедневно с воскресенья по четверг с 18:00 до 2:00, в пятницу и субботу с 18:00 до 6:00. А, если повезет, то и еще на какой-нибудь крутой концерт попадете! :)
          </p>
        </div>
        <div class="section-index__two flex">
          <a href="events.php" class="section-index__two-link">
            <h2 class="section-index__two-header">
               Наши мероприятия
            </h2>
          </a>
          <div class="section-index__two-afisha">
            <?php include 'request.php';

            foreach ($res_array as $res) {
              foreach ($res as $result) {
                $id = $result['id'];
                $name = $result['Название'];
                $poster = $result['Афиша'];
              }

              $src = "$dir/$poster";
              if ($poster && file_exists($src)) {
                echo "<div class=\"section-index__afisha flex\"><img id=\"afisha$id\" class=\"section-index__afisha-img\" src=\"$src\" alt=\"$name\"/></div>";
              } else {
                echo "<div class=\"section-index__afisha flex\"><img id=\"afisha$id\" class=\"section-index__afisha-img\" src=\"$dir/орел.jpg\" alt=\"Rock-staR Орел\"/></div>";
              }
            }?>

          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<?php include 'footer.html';?>

</body>

</html>
