var $ = require('jquery');

$(document).ready(function () {
    $mainMenu = $('.pure-menu');
    $('.menu-link').on('click', function (e) {
        $self = $(this);
        if ($self.hasClass('active')) {
            $self.removeClass('active');
            $mainMenu.removeClass('active');
        } else {
            $self.addClass('active');
            $mainMenu.addClass('active');
        }
        e.preventDefault();
    })
});