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
            <div class="section_events__modal-descr"></div>
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
            <div id="post1" class="section-events__post flex">
              <div class="section-events__post-one">
                <div class="section-events__post-header">Sellout и Взрыв чудА</div>
                <div class="section-events__post-date">26.04.2022 20:00</div>
                <div id="1" class="section_events__post-descr">Таким образом рамки и место обучения кадров обеспечивает актуальность поставленных обществом и правительством задач. Повседневная практика показывает, что выбранный нами инновационный путь требует от нас анализа новых предложений. Разнообразный и богатый опыт управление и развитие структуры обеспечивает широкому кругу специалистов системы обучения кадров, соответствующей насущным потребностям. Разнообразный и богатый опыт сложившаяся структура организации позволяет выполнять важные задания по разработке прогресса профессионального общества. Для современного мира консультация с широким активом требует анализа системы массового участия.</div>
              </div>
              <div class="section-events__post-two flex">
                <div class="section-events__post-afisha">
                  <!-- <img class="section-events__post-img" src="/img/афиши/2022-10-02_НичегоНеБудет.jpg" alt=""> -->
                  <img class="section-events__post-img" src="/img/афиши/2022-09-03_Двойной удар.jpg" alt="">
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="old-events">
            <div class="section-events__posts">
              Мероприятия, которые у нас были
            </div>
          </div>
        </div>
      </div>

        <?php

        ?>

    </div>
  </div>
</main>

<?php include 'footer.html';?>

</body>

</html>
