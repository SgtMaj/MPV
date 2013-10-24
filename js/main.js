$( document ).ready(function() {

/* Initialisation */
    // Remplace la classe de <html />
    $('html')
        .removeClass('no-js')
        .addClass('js');

/* DEV TOOLS */
    // Calcul de la hauteur de #grid
    $('#grid').height($( document ).height());

    // Affiche / masque la grid
    $('#toggle-grid').click(function() {
        $('#grid').toggleClass('hidden');
    });
    // Keypress for switch button
    $( document ).keypress(function (e) {
        if (e.which == 32) {
            $('#toggle-grid').trigger('click'); // on simule un click sur #toggle-grid
            e.preventDefault(); // annule l'action par défaut --> return false;
        }
    });

});
