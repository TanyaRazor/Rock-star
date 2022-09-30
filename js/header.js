$(document).ready(function() {

    var main_id = $('main').attr('id');

    $('a#' + main_id + "_tab").addClass('active-item');
    $('a#' + main_id + "_burger").addClass('active-item');
});