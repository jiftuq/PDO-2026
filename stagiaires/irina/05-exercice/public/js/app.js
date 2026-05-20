$(document).ready(function () {
    $('.menu-toggle').on('click', function () {
        $('.site-navigation').toggleClass('active');
    });

    var $form = $('#comment-form');
    if ($form.length === 0) {
        return;
    }

    $form.on('submit', function (event) {
        var errors = [];
        var email = $.trim($('#email').val());
        var fullName = $.trim($('#full_name').val());
        var title = $.trim($('#title').val());
        var message = $.trim($('#text_comment').val());

        function showError(fieldId, message) {
            var errorElement = $('#' + fieldId).siblings('.error-message');
            if (!errorElement.length) {
                errorElement = $('<div>').addClass('error-message').insertAfter($('#' + fieldId));
            }
            errorElement.text(message);
        }

        $('.error-message').remove();

        if (!email || email.length > 120 || !/^\S+@\S+\.\S+$/.test(email)) {
            errors.push('L\'email doit être valide et 120 caractères maximum.');
            showError('email', 'L\'email doit être valide et 120 caractères maximum.');
        }

        if (fullName.length < 5 || fullName.length > 120) {
            errors.push('Le nom complet doit contenir entre 5 et 120 caractères.');
            showError('full_name', 'Le nom complet doit contenir entre 5 et 120 caractères.');
        }

        if (title.length < 5 || title.length > 180) {
            errors.push('Le titre doit contenir entre 5 et 180 caractères.');
            showError('title', 'Le titre doit contenir entre 5 et 180 caractères.');
        }

        if (message.length < 5 || message.length > 1000) {
            errors.push('Le commentaire doit contenir entre 5 et 1000 caractères.');
            showError('text_comment', 'Le commentaire doit contenir entre 5 et 1000 caractères.');
        }

        if (errors.length > 0) {
            event.preventDefault();
            if ($('#client-errors').length === 0) {
                $('<div id="client-errors" class="error-summary"></div>').prependTo($form);
            }
            $('#client-errors').text('Le formulaire contient des erreurs. Veuillez les corriger avant de soumettre.');
            $('html, body').animate({ scrollTop: $('#client-errors').offset().top - 70 }, 300);
        }
    });
});
