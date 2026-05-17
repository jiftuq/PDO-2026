$(function () {
    const $form = $("#commentForm");

    if ($form.length === 0) {
        return;
    }

    function showError(inputSelector, errorSelector, message) {
        $(inputSelector).addClass("input-error");
        $(errorSelector).text(message);
    }

    function clearError(inputSelector, errorSelector) {
        $(inputSelector).removeClass("input-error");
        $(errorSelector).text("");
    }

    function isValidEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    $form.on("submit", function (event) {
        let isValid = true;

        const email = $("#email").val().trim();
        const fullName = $("#full_name").val().trim();
        const title = $("#title").val().trim();
        const textComment = $("#text_comment").val().trim();

        clearError("#email", "#emailError");
        clearError("#full_name", "#fullNameError");
        clearError("#title", "#titleError");
        clearError("#text_comment", "#textCommentError");

        if (email === "") {
            showError("#email", "#emailError", "L'email est obligatoire.");
            isValid = false;
        } else if (!isValidEmail(email)) {
            showError("#email", "#emailError", "L'email n'est pas valide.");
            isValid = false;
        } else if (email.length > 120) {
            showError("#email", "#emailError", "L'email ne peut pas dépasser 120 caractères.");
            isValid = false;
        }

        if (fullName.length < 5) {
            showError("#full_name", "#fullNameError", "Le nom complet doit contenir au moins 5 caractères.");
            isValid = false;
        } else if (fullName.length > 120) {
            showError("#full_name", "#fullNameError", "Le nom complet ne peut pas dépasser 120 caractères.");
            isValid = false;
        }

        if (title.length < 5) {
            showError("#title", "#titleError", "Le titre doit contenir au moins 5 caractères.");
            isValid = false;
        } else if (title.length > 180) {
            showError("#title", "#titleError", "Le titre ne peut pas dépasser 180 caractères.");
            isValid = false;
        }

        if (textComment.length < 5) {
            showError("#text_comment", "#textCommentError", "Le commentaire doit contenir au moins 5 caractères.");
            isValid = false;
        } else if (textComment.length > 1000) {
            showError("#text_comment", "#textCommentError", "Le commentaire ne peut pas dépasser 1000 caractères.");
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
});