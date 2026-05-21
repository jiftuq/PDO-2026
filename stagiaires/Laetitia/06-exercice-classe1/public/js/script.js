$(document).ready(function () {

    const THEME_KEY = 'theme';

    const savedTheme = localStorage.getItem(THEME_KEY) || 'light';
    $('html').attr('data-theme', savedTheme);

    $('#themeToggle').on('click', function () {
        const current = $('html').attr('data-theme');
        const next = current === 'dark' ? 'light' : 'dark';
        $('html').attr('data-theme', next);
        localStorage.setItem(THEME_KEY, next);
    });

    $('#hamburger').on('click', function () {
        $(this).toggleClass('open');
        $('#navLinks').toggleClass('open');
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('nav').length) {
            $('#hamburger').removeClass('open');
            $('#navLinks').removeClass('open');
        }
    });

    const $textarea = $('#text_comment');
    const $counter = $('#charCounter');
    const MAX_CHARS = 1000;

    function updateCounter() {
        const remaining = MAX_CHARS - $textarea.val().length;
        $counter.text(remaining + ' caractère' + (remaining !== 1 ? 's' : '') + ' restant' + (remaining !== 1 ? 's' : ''));

        $counter.removeClass('warning danger');
        if (remaining <= 0) {
            $counter.addClass('danger');
        } else if (remaining <= 100) {
            $counter.addClass('warning');
        }
    }

    if ($textarea.length) {
        updateCounter();
        $textarea.on('input', updateCounter);
    }

    const EMAIL_REGEX = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    function showError($input, $errorSpan) {
        $input.addClass('is-invalid');
        $errorSpan.addClass('visible');
    }

    function clearError($input, $errorSpan) {
        $input.removeClass('is-invalid');
        $errorSpan.removeClass('visible');
    }

    function validateEmail(val) {
        return EMAIL_REGEX.test(val) && val.length <= 120;
    }

    function validateLength(val, min, max) {
        return val.trim().length >= min && val.trim().length <= max;
    }

    $('#email').on('blur', function () {
        const $err = $('#error-email');
        validateEmail($(this).val()) ? clearError($(this), $err) : showError($(this), $err);
    });

    $('#full_name').on('blur', function () {
        const $err = $('#error-full_name');
        validateLength($(this).val(), 5, 120) ? clearError($(this), $err) : showError($(this), $err);
    });

    $('#title').on('blur', function () {
        const $err = $('#error-title');
        validateLength($(this).val(), 5, 180) ? clearError($(this), $err) : showError($(this), $err);
    });

    $('#text_comment').on('blur', function () {
        const $err = $('#error-text_comment');
        validateLength($(this).val(), 5, 1000) ? clearError($(this), $err) : showError($(this), $err);
    });

    $('#commentForm').on('submit', function (e) {
        let valid = true;

        const email = $('#email').val();
        const fullName = $('#full_name').val();
        const title = $('#title').val();
        const comment = $('#text_comment').val();

        if (!validateEmail(email)) {
            showError($('#email'), $('#error-email'));
            valid = false;
        } else {
            clearError($('#email'), $('#error-email'));
        }

        if (!validateLength(fullName, 5, 120)) {
            showError($('#full_name'), $('#error-full_name'));
            valid = false;
        } else {
            clearError($('#full_name'), $('#error-full_name'));
        }

        if (!validateLength(title, 5, 180)) {
            showError($('#title'), $('#error-title'));
            valid = false;
        } else {
            clearError($('#title'), $('#error-title'));
        }

        if (!validateLength(comment, 5, 1000)) {
            showError($('#text_comment'), $('#error-text_comment'));
            valid = false;
        } else {
            clearError($('#text_comment'), $('#error-text_comment'));
        }

        if (!valid) {
            e.preventDefault();
            const $firstError = $('.is-invalid').first();
            if ($firstError.length) {
                $('html, body').animate({
                    scrollTop: $firstError.offset().top - 100
                }, 300);
            }
        }
    });

});