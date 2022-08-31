$(function() {
    $('.section-header__burger-menu-icon').click(function() {
        $('.section-header__burger').css('display', 'flex');
    });
    $('.section-header__close-icon').click(function() {
        $('.section-header__burger').hide();
    });

    $(window).on('resize', function() { $('.section-header__burger').hide(); });

    // theRotator();
    // $('select').selectize({
    //     sortField: 'text'
    // });
    // $('select').select2();

});

function toggleButton() {
    $input_city = $('#input_city').val();
    $select_country = $('#countries').val();

    $input_agent = $('#agent').val();
    $input_phone = $('#phone').val();
    $select_city = $('#cities').val();

    $name_group = $('#group').val();
    $select_agent = $('#agents').val();

    $date = $('#date').val();
    $groups = $('#groups_select').val();
    $type_concert = $('#type_concert').val();
    $conditions = $('#conditions').val();
    $status = $('#status').val();

    if ($input_city && $select_country) {
        $('.add_city').attr('disabled', false);
    } else {
        $('.add_city').attr('disabled', true);
    }

    if ($input_agent && $input_phone && $select_city) {
        $('.add_agent').attr('disabled', false);
    } else {
        $('.add_agent').attr('disabled', true);
    }

    if ($name_group && $select_agent) {
        $('.add_group').attr('disabled', false);
    } else {
        $('.add_group').attr('disabled', true);
    }

    if ($date && $groups && $type_concert && $conditions && $status) {
        $('.add_concert').attr('disabled', false);
    } else {
        $('.add_concert').attr('disabled', true);
    }
}
// function theRotator() {
//     $('.section-events__fon-img').css({ opacity: 0.0 });
//     $('.section-events__fon-img:first').addClass('show').css({ opacity: 1.0 });
//     setInterval('rotate()', 10000);
// }

// function rotate() {
//     var current = ($('.section-events__fon-img.show') ? $('.section-events__fon-img.show') : $('.section-events__fon-img:first'));
//     var next = ((current.next().length) ? ((current.next().hasClass('show')) ? $('.section-events__fon-img:first') : current.next()) : $('.section-events__fon-img:first'));

//     // Расскомментируйте, чтобы показвать картинки в случайном порядке
//     // var sibs = current.siblings();
//     // var rndNum = Math.floor(Math.random() * sibs.length );
//     // var next = $( sibs[ rndNum ] );

//     next.css({ opacity: 0.0 })
//         .addClass('show')
//         .animate({ opacity: 1.0 }, 1000);

//     current.animate({ opacity: 0.0 }, 1000)
//         .removeClass('show');
// };