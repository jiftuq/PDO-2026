// 05-exercice/public/js/script.js
// Menu hamburger + validation frontend (jQuery)

$(function () {

    // ===== Menu hamburger =====
    $('#burger').on('click', function () {
        $('#menu-links').toggleClass('open');
    });

    // ferme le menu après clic sur un lien (mobile)
    $('#menu-links a').on('click', function () {
        $('#menu-links').removeClass('open');
    });

    // ===== Validation frontend du formulaire =====
    // (Le backend reste la source de vérité — cf. cours)
    const $form = $('#comment-form');
    if ($form.length) {

        const rules = {
            email:        { min: 0, max: 120,  type: 'email' },
            fullName:     { min: 5, max: 120,  type: 'text'  },
            title:        { min: 5, max: 180,  type: 'text'  },
            text_comment: { min: 5, max: 1000, type: 'text'  }
        };

        function validateField($el) {
            const name = $el.attr('name');
            const val  = $.trim($el.val());
            const rule = rules[name];
            if (!rule) return true;

            let valid = true;

            if (rule.type === 'email') {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!re.test(val) || val.length > rule.max) valid = false;
            } else {
                if (val.length < rule.min || val.length > rule.max) valid = false;
            }

            $el.toggleClass('invalid', !valid);
            return valid;
        }

        // validation en live
        $form.find('input, textarea').on('blur input', function () {
            validateField($(this));
        });

        // validation au submit
        $form.on('submit', function (e) {
            let allOk = true;
            $form.find('input, textarea').each(function () {
                if (!validateField($(this))) allOk = false;
            });
            if (!allOk) {
                e.preventDefault();
                alert("Le formulaire contient des erreurs. Merci de les corriger.");
            }
        });
    }
});
