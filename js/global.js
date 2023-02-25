function setupSearch() {
    $('#header .toggle-hide').on('click', function (e) {
        e.preventDefault();
        if ($('#menu').hasClass('active')) return; // Prevent toggle in mobile
        vancoufur_toggle_main_search();
    });
    $('#header .search-field').on('focus', function () {
        if ($('#header .toggle-hide').data('enabled') !== true) {
            vancoufur_toggle_main_search();
        }
    });
    $('#header .search-form').on('scroll', function () {
        this.scrollLeft = 0;
    }).on('keyup', function (e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            $('#header .search-submit').click();
        }
    });
    $('#header .search-field, #header .search-submit').css({
        'position': 'absolute',
        'left': '-100vw'
    });
}

function setupNav() {
    $('.menu-item-has-children > a').append(' ').append($('<i>').addClass('fas fa-caret-down'));
    $('.menu-toggle-mobile').on('click', function () {
        let active = $('#menu').toggleClass('active').hasClass('active');
        if (($('#header .toggle-hide').data('enabled') !== true && active) ||
            ($('#header .toggle-hide').data('enabled') === true && !active)) {
            // sync open state with nav
            if (active) {
                $(document.body).addClass("scroll-lock");
                setTimeout(vancoufur_toggle_main_search, 300);
            }
            else {
                $(document.body).removeClass("scroll-lock");
                vancoufur_toggle_main_search();
            }
        }
        return false;
    });
    $(`.main-menu>ul>li.menu-item-has-children>a[href='#']`).on('click', function (){return false;})
}

function setupFooter() {
    $(window).on('scroll', toggleOnScroll);
    toggleOnScroll();
    $('#return-to-top').on('click', function (e) {
        e.preventDefault();
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
}

function toggleOnScroll() {
    $('#return-to-top').css('bottom',
        (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) ? '1em' : '-3em'
    );
}

let timeout;

function vancoufur_toggle_main_search() {
    let button = $('#header .toggle-hide');
    if ($(button).data('enabled') !== true) {
        $('#search').addClass('active');
        $('#header .search-field, #header .search-submit').removeAttr('style');
        $(button).addClass('active').data('enabled', true);
        $('#header .search-form')
            .css('background', 'rgba(255,255,255,1)')
            .css('width', '312px');
        if ($('#menu').hasClass('active')) return; // Prevent focus in mobile
        $('#header .search-field').focus();
        clearTimeout(timeout);
    } else {
        $('#search').removeClass('active');
        $(button).removeClass('active').data('enabled', false);
        $('#header .search-form')
            .css('background', 'rgba(255,255,255,0)')
            .css('width', '2em');
        timeout = setTimeout(function () {
            $('#header .search-field, #header .search-submit').css({
                'position': 'absolute',
                'left': '-100vw'
            });
        }, 250);
    }
}

$(document).ready(function () {
    setupSearch();
    setupNav();
    setupFooter();
});