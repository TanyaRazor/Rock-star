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

        <!-- <ul class="nav nav-tabs" id="my-tab">
          <li class="nav-item" role="navigation">
            <a class="nav-link active" aria-current="new-events" href="#new-events">Предстоящие</a>
          </li>
          <li class="nav-item" role="navigation">
            <a class="nav-link" aria-current="old-events" href="#old-events">Архив</a>
          </li>

        </ul> -->
        <ul class="nav nav-tabs" role="tablist" id="my-tab">
          <li class="nav-item" role="presentation">
            <button class="nav-link events_tab active" id="new-events_tab" data-bs-toggle="tab" data-bs-target="#new-events" type="button" role="tab" aria-controls="new-events" onClick='location.href="/events.php#new-events"'>Предстоящие</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link events_tab" id="old-events_tab" data-bs-toggle="tab" data-bs-target="#old-events" type="button" role="tab" aria-controls="old-events" onClick='location.href="/events.php#old-events"'>Архив</button>
          </li>

        </ul>
        <div class="tab-content">



          <div class="tab-pane fade events_content show active" id="new-events">

            <?php include 'request.php';
            foreach ($res_array as $res) {
              foreach ($res as $result) {
                $id = $result['id'];
                $data = $result['Дата и время'];
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


            if ($new_concerts->num_rows > 0) {
          echo "<div id=\"new-post-$id\" class=\"section-events__post flex\">
                  <div class=\"section-events__post-one\">
                    <a href=\"javascript:void(0);\"><div class=\"section-events__post-header\">$name</div></a>
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
          }
          if ($limit_page_new > 1){
            $hash_new = "#new-events";
          echo "<ul class=\"pagination\">";
            if ($page != 1){
              $prev = $page - 1;
              $class = "";
            }else{
              $prev = $page;
              $class = " disabled";
            }
              echo "<li class=\"page-item$class\">
              <a class=\"page-link\" href=\"?page=$prev$hash_new\" aria-label=\"Previous\">
                <span aria-hidden=\"true\">&laquo;</span>
              </a>
            </li>";

            for ($i = 1; $i <= $limit_page_new; $i++){
              if ($page == $i){
                $class = " active";
              }else{
                $class = "";
              }
              echo "<li class=\"page-item$class\"><a class=\"page-link\" href=\"?page=$i$hash_new\">$i</a></li>";

            }

            if ($page != $limit_page_new){
              $next = $page + 1;
              $class = "";
            }else{
              $next = $page;
              $class = " disabled";
            }
            echo "<li class=\"page-item$class\">
              <a class=\"page-link\" href=\"?page=$next$hash_new\" aria-label=\"Next\">
                <span aria-hidden=\"true\">&raquo;</span>
              </a>
            </li>
          </ul>";
        }?>
        </div>
        <?php if ($archive_concerts->num_rows > 0) {
                echo "<div class=\"tab-pane fade events_content\" id=\"old-events\">";
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
                      <div class=\"section-events__post-header\">$name</div></a>
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
            }
            if ($limit_page_old > 1){
              $hash_old = "#old-events";
            echo "<ul class=\"pagination\">";
              if ($page != 1){
                $prev = $page - 1;
                $class = "";
              }else{
                $prev = $page;
                $class = " disabled";
              }
                echo "<li class=\"page-item$class\">
                <a class=\"page-link\" href=\"?page=$prev$hash_old\" aria-label=\"Previous\">
                  <span aria-hidden=\"true\">&laquo;</span>
                </a>
              </li>";

              for ($i = 1; $i <= $limit_page_old; $i++){
                if ($page == $i){
                  $class = " active";
                }else{
                  $class = "";
                }
                echo "<li class=\"page-item$class\"><a class=\"page-link\" href=\"?page=$i$hash_old\">$i</a></li>";

              }

              if ($page != $limit_page_old){
                $next = $page + 1;
                $class = "";
              }else{
                $next = $page;
                $class = " disabled";
              }
              echo "<li class=\"page-item$class\">
                <a class=\"page-link\" href=\"?page=$next$hash_old\" aria-label=\"Next\">
                  <span aria-hidden=\"true\">&raquo;</span>
                </a>
              </li>
            </ul>";
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
