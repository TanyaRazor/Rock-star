$(document).ready(function() {

    var main_id = $('main').attr('id');

    $('a#' + main_id).addClass('active-item');
    $('a#' + main_id + "_burger").addClass('active-item');
});