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
    $('.section-events__fon-img').css({ opacity: 0.0 });
    $('.section-events__fon-img:first').addClass('show').css({ opacity: 1.0 });
    setInterval('rotate()', 10000);
}

function rotate() {
    var current = ($('.section-events__fon-img.show') ? $('.section-events__fon-img.show') : $('.section-events__fon-img:first'));
    var next = ((current.next().length) ? ((current.next().hasClass('show')) ? $('.section-events__fon-img:first') : current.next()) : $('.section-events__fon-img:first'));

    // Расскомментируйте, чтобы показвать картинки в случайном порядке
    // var sibs = current.siblings();
    // var rndNum = Math.floor(Math.random() * sibs.length );
    // var next = $( sibs[ rndNum ] );

    next.css({ opacity: 0.0 })
        .addClass('show')
        .animate({ opacity: 1.0 }, 1000);

    current.animate({ opacity: 0.0 }, 1000)
        .removeClass('show');
};
