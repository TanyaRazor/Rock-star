$(document).ready(function() {

    var main_id = $('main').attr('id');
    var title_type = '';
    switch (main_id) {
        case "index":
            title_type = 'Официальный сайт';
            break;
        case 'events':
            title_type = 'Наши мероприятия';
            break;
        case 'catalog':
            title_type = 'Каталог песен';
            break;
        case 'about':
            title_type = 'О нас';
            break;
    }


    $('title').text('Караоке бар Rock-staR - ' + title_type);
    var title = $('title').text();

    $('a#' + main_id + "_tab").addClass('active-item');
    $('a#' + main_id + "_burger").addClass('active-item');
});