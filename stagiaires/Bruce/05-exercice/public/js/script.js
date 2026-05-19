$(function () {

    // ---- Menu hamburger ----
    $('#hamburger').on('click', function () {
        $('#navMenu').toggleClass('open');
    });

    // ---- Validation frontend du formulaire ----
    $('#commentForm').on('submit', function (e) {

        $('.error-js').remove();

        var valid = true;

        var email = $('#email').val().trim();
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email) || email.length > 120) {
            $('#email').after('<p class="error error-js">Email invalide ou trop long (max 120 caractères)</p>');
            valid = false;
        }

        var fullName = $('#full_name').val().trim();
        if (fullName.length < 5 || fullName.length > 120) {
            $('#full_name').after('<p class="error error-js">Nom : entre 5 et 120 caractères</p>');
            valid = false;
        }

        var title = $('#title').val().trim();
        if (title.length < 5 || title.length > 180) {
            $('#title').after('<p class="error error-js">Titre : entre 5 et 180 caractères</p>');
            valid = false;
        }

        var text = $('#text_comment').val().trim();
        if (text.length < 5 || text.length > 1000) {
            $('#text_comment').after('<p class="error error-js">Commentaire : entre 5 et 1000 caractères</p>');
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
        }
    });

});
