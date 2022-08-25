$(function() {
    $('.section-header__burger-menu-icon').click(function() {
        $('.section-header__burger').css('display', 'flex');
    });
    $('.section-header__close-icon').click(function() {
        $('.section-header__burger').hide();
    });

    $(window).on('resize', function() { $('.section-header__burger').hide(); });

    theRotator();
});

function theRotator() {
    // Устанавливаем прозрачность всех картинок в 0
    $('.section-events__fon-img').css({ opacity: 0.0 });

    // Берем первую картинку и показываем ее (по пути включаем полную видимость)
    $('.section-events__fon-img:first').addClass('show').css({ opacity: 1.0 });

    // Вызываем функцию rotate для запуска слайдшоу, 5000 = смена картинок происходит раз в 5 секунд
    setInterval('rotate()', 10000);
}

function rotate() {
    // Берем первую картинку
    var current = ($('.section-events__fon-img.show') ? $('.section-events__fon-img.show') : $('.section-events__fon-img:first'));

    // Берем следующую картинку, когда дойдем до последней начинаем с начала
    var next = ((current.next().length) ? ((current.next().hasClass('show')) ? $('.section-events__fon-img:first') : current.next()) : $('.section-events__fon-img:first'));

    // Расскомментируйте, чтобы показвать картинки в случайном порядке
    // var sibs = current.siblings();
    // var rndNum = Math.floor(Math.random() * sibs.length );
    // var next = $( sibs[ rndNum ] );

    // Подключаем эффект растворения/затухания для показа картинок, css-класс show имеет больший z-index
    next.css({ opacity: 0.0 })
        .addClass('show')
        .animate({ opacity: 1.0 }, 1000);

    // Прячем текущую картинку
    current.animate({ opacity: 0.0 }, 1000)
        .removeClass('show');
};
