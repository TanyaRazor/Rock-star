$(function() {


    $(".chosen-select").chosen();

    $('.section-header__burger-menu-icon').click(function() {
        $('.section-header__burger').css('display', 'flex');
    });
    $('.section-header__close-icon').click(function() {
        $('.section-header__burger').hide();
    });

    $(window).on('resize', function() { $('.section-header__burger').hide(); });

    autosize(document.querySelectorAll('textarea'));
    $(document).on('focus', 'textarea', function() {

        document.querySelectorAll("textarea").scrollIntoView();

    });
    // theRotator();
    // $('select').selectize({
    //     sortField: 'text'
    // });
    // $('select').select2();

    $('.section-index__afisha-img').click(function() {
        let src = $(this).attr('src');
        $('.modal_img img').attr('src', src);
        $('.modal_img').fadeIn();
    });
    // $('.close').click(function() {
    //     $('.modal_img').fadeOut();
    // });

    $(document).click(function(e) {
        if ($(e.target).is('.modal_img img')) {
            $('.modal_img').fadeOut();
        }
    });


    $('.section-events__post').click(function() {
        let id = $(this).attr('id');
        let header = $('#' + id).find(".section-events__post-header").text();
        let date = $('#' + id).find(".section-events__post-date").text();
        let descr = $('#' + id).find(".section_events__post-descr").text();
        let src = $('#' + id).find(".section-events__post-img").attr('src');
        $('.section-events__modal-header').text(header);
        $('.section-events__modal-date').text(date);
        $('.section_events__modal-descr').text(descr);
        $('.section-events__modal-img').attr('src', src);

        $('.modal_post').fadeIn();
    });


    $("button").on("click", function() {
        let id = $(this).attr("id");
        $('#modal_' + id).fadeIn();
    });

    // $(".pagination").on("click", function() {
    //     let modal_id = $(this).parent().attr("id");
    //     const someTabTriggerEl = document.querySelector('button[data-bs-target="#"' + modal_id + ']');
    //     console.log(someTabTriggerEl);
    //     //const tab = new bootstrap.Tab(someTabTriggerEl);

    //     //tab.show();
    //     // $(".nav-link[data-bs-target='#' + modal_id]").addClass("active");
    // });


    $(".nave-link").click(function(e) {
        $(".nav-link").removeClass("active");
        $(this).addClass("active");
        let id = $(this).attr("data-bs-target");
        $(".tab-pane").removeClass("active show");
        $(id).addClass('active show');
    });


    $(document).on("input", "textarea", function() {
        $(this).outerHeight(38).outerHeight(this.scrollHeight);
    });


    // $('.btn_add_agent').click(function() {
    //     $('.modal_post').fadeIn();
    // });
    // $('.btn_add_group').click(function() {
    //     $('.modal_post').fadeIn();
    // });
    // $('.btn_add_event').click(function() {
    //     $('.modal_post').fadeIn();
    // });

    $(document).click(function(e) {
        if ($(e.target).is('.modal_post form') || $(e.target).is('.modal_post') || $(e.target).is('.modal_post div')) {
            $('.modal_post').fadeOut();
        }
    });

    // if ($('#load_image_edit').val()) {
    // var name_poster = $('#load_image_edit').val();
    // $('#poster_img_edit').attr("value", "123");
    // var name_poster = $('#load_image_edit').val();
    // $('#poster_img_edit').attr("value", name_poster);
    // }

    $("#load_image_edit").on("change", function() {
        // if ($('#load_image_edit').val()) {

        // }

        // Обрабатываем объект добавленного изображения
        var $input = $(this),
            reader = new FileReader();
        reader.onload = function() {
            $("#poster_edit").attr("src", reader.result);
        };
        reader.readAsDataURL($input[0].files[0]);
    });
    // Get the modal
    // var modal = $('#myModal');

    // // Get the image and insert it inside the modal - use its "alt" text as a caption
    // var img = document.getElementById('afisha');
    // var modalImg = document.getElementById("img01");
    // var captionText = document.getElementById("caption");
    // img.onclick = function() {
    //     modal.style.display = "block";
    //     modalImg.src = this.src;
    //     captionText.innerHTML = this.alt;
    // }

    // Get the <span> element that closes the modal
    // var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    // span.onclick = function() {
    //     modal.style.display = "none";
    // }
});

$(document).ready(function() {
    let hash = window.location.hash;
    switch (window.location.hash) {
        case '':
            $('#all_agents_tab, #new-events_tab').addClass('active');
            $('#all_agents, #new-events').addClass('active show');
            break;
        case hash:
            $('.admin_tab').removeClass('active');
            $('.events_tab').removeClass('active');
            $(hash + '_tab').addClass('active');
            $('.admin_contents').removeClass('active show');
            $('.events_contents').removeClass('active show');
            $(hash).addClass('active show');
            break;

    }
});

function toggleButton() {
    $input_agent = $('#agent').val();

    $name_group = $('#group').val();
    $select_agent = $('#agents').val();

    $date = $('#date').val();
    $name_activity = $('#name_activity').val();
    $status = $('#status').val();

    $concerts_name = $("#concerts_name").val();
    $post = $("#post").val();

    if ($input_agent) {
        $('.add_agent').attr('disabled', false);
    } else {
        $('.add_agent').attr('disabled', true);
    }

    if ($name_group && $select_agent) {
        $('.add_group').attr('disabled', false);
    } else {
        $('.add_group').attr('disabled', true);
    }

    if ($date && $name_activity && $status) {
        $('.add_concert').attr('disabled', false);
    } else {
        $('.add_concert').attr('disabled', true);
    }

    if ($concerts_name && $post) {
        $('.add_post').attr('disabled', false);
    } else {
        $('.add_post').attr('disabled', true);
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