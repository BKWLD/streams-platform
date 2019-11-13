$(function () {

    $('body').on('click', '[data-toggle="dropdown"]', function (e) {
        var current = $(this);
        var menu = current.next();
        $(menu).css({ "bottom": "auto", "top": "100%" });

        setTimeout(function () {
            if ($(menu).outerHeight() + $(menu).offset().top >= $(window).scrollTop() + $(window).height()) {
                $(menu).css({ 'bottom': '100%', 'top': 'auto' });
            }
        }, 0)
    });

    $('body').on('click', '[data-toggle="lang"]', function (e) {

        e.preventDefault();

        var selected = $(this);
        var locale = selected.attr('lang');
        var form = selected.closest('form');

        var triggers = form.find('[data-toggle="lang"]');
        var group = triggers.closest('.btn-group');
        var toggle = group.find('.dropdown-toggle');
        var dropdown = group.find('.dropdown-menu');

        toggle.text(selected.text());

        dropdown.find('a').removeClass('active');
        selected.addClass('active');

        form.find('.form-group[lang]').addClass('hidden');
        form.find('.form-group[lang="' + locale + '"]').removeClass('hidden');
    });
});
