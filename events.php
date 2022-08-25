<!DOCTYPE html>
<html lang="ru">

<?php include 'head.html';?>

<body>

<?php include 'header.html';?>
<main id="events">
  <div class="section-events">
    <div class="container-fluid section-events__container">
      <h2 class="header section-events__header">Наши мероприятия</h2>
      <div class="section-events__fon slider">

        <?php
          $dir = 'img/афиши/';
          $f = scandir($dir);
          foreach ($f as $file){
              if(preg_match('/\.(jpg)/', $file)){
                  echo "<img class=\"section-events__fon-img\" src=\"$dir$file\" alt=\"fon\"/>";
              }
          }
        ?>

      </div>

    </div>
  </div>
</main>

<?php include 'footer.html';?>

</body>

</html>
