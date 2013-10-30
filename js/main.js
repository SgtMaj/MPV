$(document).ready(function() {

/* Initialisation */
    // Remplace la classe de <html />
    $('html')
        .removeClass('no-js')
        .addClass('js');

    // Ajoute la classe "current" au lien de menu courant
    var queryString = window.location.search.split('='),
        currentPage = (queryString[1]) ? queryString[1] : 'home';

    $('#main-nav a').removeClass('current');
    $('#nav-' + currentPage).addClass('current');

/* Message flash */
    var alert = $('#alert');
    if (alert.length > 0) {
        alert
            .hide()
            .slideDown(500)
            .delay(30000)
            .slideUp();
    }

    var close = $('.alert-close');
    close.click(function(e) {
        e.preventDefault();
        alert.slideUp(500).hide();
    });

});
