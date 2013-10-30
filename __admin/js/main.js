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


    /* Drag'n'Drop */
    $(document).on('dragenter', '#dropfile', function() {
        $(this).css('border', '3px dashed red');
        return false;
    });

    $(document).on('dragover', '#dropfile', function(e){
        e.preventDefault();
        e.stopPropagation();
        $(this).css('border', '3px dashed red');
        return false;
    });

    $(document).on('dragleave', '#dropfile', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).css('border', '3px dashed #BBBBBB');
        return false;
    });

    $(document).on('drop', '#dropfile', function(e) {
        if (e.originalEvent.dataTransfer) {
            if (e.originalEvent.dataTransfer.files.length) {
               e.preventDefault();
               e.stopPropagation();
               $(this).css('border', '3px dashed green');

               upload(e.originalEvent.dataTransfer.files);
           }
        }
        else {
           $(this).css('border', '3px dashed #BBBBBB');
        }

        return false;
    });

    function upload(files) {
        var f = files[0] ;
        // Only process image files.
        var formAuth = ['image/jpg','image/jpeg','image/png'];
        if (jQuery.inArray(f.type, formAuth) == -1) {
           alert('The file must be a jpeg or a png image') ;
           return false ;
        }
        // var reader = new FileReader();

        // When the image is loaded,
        // run handleReaderLoad function
        $('#carrousel-submit').click(handleReaderLoad);

        // Read in the image file as a data URL.
        // reader.readAsDataURL(f);
    }

    function checkUpload(e) {
        if($('#carrousel-title').val() == "" && $('#carrousel-text').val() == "" && $('#carrousel-alt').val() == "" && $('#carrousel-weight').val() == "") {

            console.log("faux");
        }
    }

    function handleReaderLoad() {
        checkUpload();

        var str,
            title = $('#carrousel-title').val(),
            text = $('#carrousel-text').val(),
            alt = $('#carrousel-alt').val(),
            weight = $('#carrousel-weight').val();

        $.ajax({
            type: 'POST',
            url: '../index.php',
            data: {title: title, text: text, alt: alt, weight: weight},
            success: function(data) {
                // do_something(data);
        }});
    }


/* DEV TOOLS */
    // Calcul de la hauteur de #grid
    $('#grid').height($(document).height());

    // Affiche / masque la grid
    $('#toggle-grid').click(function() {
        $('#grid').toggleClass('hidden');
    });
    // Keypress for switch button
    $(document).keypress(function(e) {
        if (e.which == 32) {
            $('#toggle-grid').trigger('click'); // on simule un click sur #toggle-grid
            e.preventDefault(); // annule l'action par défaut --> return false;
        }
    });

});



