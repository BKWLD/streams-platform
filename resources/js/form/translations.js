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
        var featuredTypes = $('[class*="featured"].multiple-field_type');

        var triggers = form.find('[data-toggle="lang"]');
        var group = triggers.closest('.btn-group');
        var toggle = group.find('.dropdown-toggle');
        var dropdown = group.find('.dropdown-menu');

        toggle.text(selected.text());

        dropdown.find('a').removeClass('active');
        selected.addClass('active');

        form.find('.form-group[lang]').addClass('hidden');
        form.find('.form-group[lang="' + locale + '"]').removeClass('hidden');

        var toggleFeaturedTypesLocale = function(locale) {
            $('.featured_' + locale + '-field').parent().show();
            $('[class*="featured"]:not(.featured_' + locale +'-field).multiple-field_type').each(function (i, el) {
                $(el).parent().hide();
            });
        }

        switch (locale) {
            case 'ca':
                toggleFeaturedTypesLocale('ca')
                break;
            case 'fr-ca':
                toggleFeaturedTypesLocale('fr-ca')
                break;
            case 'de':
                toggleFeaturedTypesLocale('de')
                break;
            case 'be':
                toggleFeaturedTypesLocale('be')
                break;
            case 'se':
                toggleFeaturedTypesLocale('se')
                break;
            case 'gb':
                toggleFeaturedTypesLocale('gb')
                break;
            case 'fr':
                toggleFeaturedTypesLocale('fr')
                break;
            case 'pt':
                toggleFeaturedTypesLocale('pt')
                break;
            case 'nl':
                toggleFeaturedTypesLocale('nl')
                break;
            case 'au':
                toggleFeaturedTypesLocale('au')
                break;
            case 'es':
                toggleFeaturedTypesLocale('es')
                break;
            case 'it':
                toggleFeaturedTypesLocale('it')
                break;
            case 'fi':
                toggleFeaturedTypesLocale('fi')
                break;
            case 'nz':
                toggleFeaturedTypesLocale('nz')
                break;
            case 'en':
                $('.featured-field').parent().show();
                $('[class*="featured"]:not(.featured-field).multiple-field_type').each(function (i, el) {
                    $(el).parent().hide();
                });
                break;
            default:
                console.log('no locale found');
        }

    });

    // Show only the EN featured field
    $('[class*="featured"]:not(.featured-field).multiple-field_type').each(function (i, el) {
        $(el).parent().hide();
    });
});
