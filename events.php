<!DOCTYPE html>
<html lang="ru">

<?php include 'head.html';?>

<body>

<?php include 'header.html';?>
<main id="events">
  <div class="section-events">
    <div class="container-fluid section-events__container">

      <div id="myModalPost" class="modal_post">
        <div class="modal-content_post" id="post">
          <div class="section-events__modal-header"></div>
          <div class="section-events__modal-date"></div>
          <div class="section-events__modal-one flex">
            <pre class="section_events__modal-descr"></pre>
            <div class="section-events__modal-afisha">
              <img class="section-events__modal-img" src="" alt="">
            </div>
          </div>
        </div>
      </div>

      <h2 class="header section-events__header">Наши мероприятия</h2>
      <div class="section-events__posts">

        <ul class="nav nav-tabs" role="tablist" id="my-tab">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="tab1" data-bs-toggle="tab" data-bs-target="#new-events" type="button" role="tab" aria-controls="new-events" aria-selected="true">Предстоящие</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab2" data-bs-toggle="tab" data-bs-target="#old-events" type="button" role="tab" aria-controls="old-events" aria-selected="true">Архив</button>
          </li>

        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="new-events">
          <?php include 'request.php';
            foreach ($res_array as $res) {
              foreach ($res as $result) {
                $id = $result['id'];
                $data = $result['Дата'];
                $name = $result['Название'];
                $poster = $result['Афиша'];
              }

              $sql_post = mysqli_query($con,"SELECT `текст` FROM `Посты` WHERE `id_концерта` = $id");

              $post = "";
              if(mysqli_num_rows($sql_post) > 0){
                foreach ($sql_post as $p){
                  $post = $p['текст'];
                }
              }


              echo "<div id=\"new-post-$id\" class=\"section-events__post flex\">
                  <div class=\"section-events__post-one\">
                    <div class=\"section-events__post-header\">$name</div>
                    <div class=\"section-events__post-date\">$data</div>
                    <div class=\"section_events__post-descr\">$post</div>
                  </div>
                  <div class=\"section-events__post-two flex\">
                    <div class=\"section-events__post-afisha\">";

                    $src = "$dir/$poster";
                    if ($poster && file_exists($src)) {
                      echo "<img id=\"afisha\" class=\"section-events__post-img\" src=\"$src\" alt=\"$name\"/>";
                    } else {
                      echo "<img id=\"afisha\" class=\"section-events__post-img\" src=\"$dir/орел.jpg\" alt=\"Rock-staR Орел\"/>";
                    }

                    echo "</div>
                  </div>
                </div>";

            }
            echo "</div>
                <div class=\"tab-pane fade\" id=\"old-events\">";
                foreach ($archive_array as $res) {
                  foreach ($res as $result) {
                    $id = $result['id'];
                    $data = $result['Дата'];
                    $name = $result['Название'];
                    $poster = $result['Афиша'];
                  }

                  $sql_post = mysqli_query($con,"SELECT `текст` FROM `Посты` WHERE `id_концерта` = $id");

                  $post = "";
                  if(mysqli_num_rows($sql_post) > 0){
                    foreach ($sql_post as $p){
                      $post = $p['текст'];
                    }
                  }


              echo "<div id=\"archive-post-$id\" class=\"section-events__post flex\">
                      <div class=\"section-events__post-one\">
                        <div class=\"section-events__post-header\">$name</div>
                        <div class=\"section-events__post-date\">$data</div>
                        <div class=\"section_events__post-descr\">$post</div>
                      </div>
                      <div class=\"section-events__post-two flex\">
                      <div class=\"section-events__post-afisha\">";

                      $src = "$dir/$poster";
                      if ($poster && file_exists($src)) {
                        echo "<img id=\"afisha\" class=\"section-events__post-img\" src=\"$src\" alt=\"$name\"/>";
                      } else {
                        echo "<img id=\"afisha\" class=\"section-events__post-img\" src=\"$dir/орел.jpg\" alt=\"Rock-staR Орел\"/>";
                      }
                      echo "</div>
                  </div>
                </div>";
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include 'footer.html';?>

</body>

</html>
