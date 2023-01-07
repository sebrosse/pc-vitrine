jQuery(document).ready(function ($) {
    'use strict';

    var pcvInit = {
        i: function (e) {
            pcvInit.s();
            pcvInit.methods();
        },

        s: function (e) {
            this._window = $(window),
                this._document = $(document),
                this._body = $('body'),
                this._html = $('html')
        },

        methods: function (e) {
            pcvInit.mobileMenuActivation();
            pcvInit.focusSearchBox();
            pcvInit.w();
            pcvInit.waitingJs();
            pcvInit.isFavorite()
            pcvInit.addFavorite();
            pcvInit.removeFavorite();
            pcvInit.hasAlert();
            pcvInit.addAlert();
            pcvInit.editAlert();
            pcvInit.removeAlert();
            pcvInit.headerIconToggle();
            pcvInit.stickyHeaderMenu();
            pcvInit.sideOffcanvasToggle('.axil-search', '#header-search-modal');
            pcvInit.sideOffcanvasToggle('.mobile-nav-toggler', '.header-main-nav');
        },

        mobileMenuActivation: function (e) {

            $('.menu-item-has-children > a').on('click', function (e) {

                var targetParent = $(this).parents('.header-main-nav');
                var target = $(this).siblings('.axil-submenu');

                if (targetParent.hasClass('open')) {
                    $(target).slideToggle(400);
                    $(this).parent('.menu-item-has-children').toggleClass('open');
                }

            });

            $('.nav-link.has-megamenu').on('click', function (e) {

                var $this = $(this),
                    targetElm = $this.siblings('.megamenu-mobile-toggle');
                targetElm.slideToggle(500);
            });

            // Mobile Sidemenu Class Add
            function resizeClassAdd() {
                if (window.matchMedia('(max-width: 1199px)').matches) {
                    $('.department-title').addClass('department-side-menu');
                    $('.department-megamenu').addClass('megamenu-mobile-toggle');
                } else {
                    $('.department-title').removeClass('department-side-menuu');
                    $('.department-megamenu').removeClass('megamenu-mobile-toggle').removeAttr('style');
                }
            }

            $(window).resize(function () {
                resizeClassAdd();
            });

            resizeClassAdd();
        },

        focusSearchBox: function () {
            this._body.on('click', '.product-search-input', function () {
                setTimeout(function () {
                    $('#autocomplete-0-input').focus();
                },250);
            });
        },

        w: function (e) {
            this._window.on('load', pcvInit.l).on('scroll', pcvInit.res)
        },

        waitingJs: function (e) {
            this._body.on('click', '.waiting-js', function (e) {
                e.preventDefault();
                return false;
            });
        },

        isFavorite: function (e) {

            if ($('.add-to-favorites').length > 0 && pcv_vars.is_user_logged_in) {
                $('.add-to-favorites').each(function () {
                    var pid = $(this).data('pid');
                    $(this).addClass('waiting-js');
                    pcvAjax('is_favorite', {'pid': pid}, 0)
                        .then((response) => {
                            if (response.success && response.data) {
                                $(this).removeClass('add-favorite-js').addClass('active remove-favorite-js');
                                $(this).data('fid', response.data.id);
                            }
                            $(this).removeClass(' waiting-js');
                        });
                })
            }
        },

        addFavorite: function (e) {
            this._body.on('click', '.add-favorite-js:not(.waiting-js)', function (e) {
                e.preventDefault();
                var pid = $(this).data('pid');
                $(this).addClass('active waiting-js');
                pcvAjax('add_favorite', {'pid': pid}, 1)
                    .then((response) => {
                        $(this).removeClass('add-favorite-js waiting-js').addClass('remove-favorite-js');
                        $(this).data('fid', response.data.id);
                    });
            })
        },

        removeFavorite: function (e) {
            this._body.on('click', '.remove-favorite-js:not(.waiting-js)', function (e) {
                e.preventDefault();
                var fid = jQuery(this).data('fid');
                $(this).removeClass('active');
                $(this).addClass('waiting-js');
                $(this).parents('.table-list-item').addClass('waiting-css');
                pcvAjax('remove_favorite', {'fid': fid}, 1)
                    .then((response) => {
                        $(this).removeClass('remove-favorite-js waiting-js').addClass('add-favorite-js');
                        $(this).parents('.table-list-item').remove();
                    });
            });
        },

        hasAlert: function () {
            if ($('.alert-wrapper').length > 0 && pcv_vars.is_user_logged_in) {
                let $addAlertJs = $('.add-alert-js');
                $addAlertJs.addClass('waiting-js');
                let pid = $addAlertJs.data('pid');
                pcvAjax('has_alert', {'pid': pid}, 0)
                    .then((response) => {
                        if (response.success && response.data) {
                            $addAlertJs.removeClass('waiting-js');
                            $('.alert-wrapper').prepend(response.data);
                        }
                        $addAlertJs.removeClass(' waiting-js');
                    });
            }
        },

        addAlert: function (e) {
            this._body.on('click', '.add-alert-js:not(.waiting-js)', function (e) {
                e.preventDefault();
                var pid = $(this).data('pid');
                var threshold = $('#alert-threshold').val();
                $(this).addClass('waiting-js');
                pcvAjax('add_alert', {'pid': pid, 'threshold': threshold}, 1)
                    .then((response) => {
                        $(this).removeClass('waiting-js');
                        $('.alert-wrapper').prepend(response.data);
                    });
            });
        },

        editAlert: function (e) {
            $('body').on('click', '.edit-alert-js', function (e) {
                e.preventDefault();
                $(this).parents('.alert-tag').remove();
                $('#alert-threshold').focus();
            });
        },

        removeAlert: function (e) {
            this._body.on('click', '.remove-alert-js:not(.waiting-js)', function (e) {
                e.preventDefault();
                var aid = jQuery(this).data('aid');
                $(this).addClass('waiting-js');
                $(this).parents('.table-list-item').addClass('waiting-css');
                $(this).parents('.alert-tag').addClass('waiting-css');
                pcvAjax('remove_alert', {'aid': aid}, 1)
                    .then((response) => {
                        $(this).parents('.alert-tag').remove();
                        $(this).parents('.table-list-item').remove();
                    });
            });
        },

        headerIconToggle: function () {

            $('.my-account > a').on('click', function (e) {
                $(this).toggleClass('open').siblings().toggleClass('open');
            })
        },

        stickyHeaderMenu: function () {

            $(window).on('scroll', function () {
                // Sticky Class Add
                if ($('body').hasClass('sticky-header')) {
                    var stickyPlaceHolder = $('#axil-sticky-placeholder'),
                        menu = $('.axil-mainmenu'),
                        menuH = menu.outerHeight(),
                        topHeaderH = $('.axil-header-top').outerHeight() || 0,
                        headerCampaign = $('.header-top-campaign').outerHeight() || 0,
                        targrtScroll = topHeaderH + headerCampaign;
                    if ($(window).scrollTop() > targrtScroll) {
                        menu.addClass('axil-sticky');
                        stickyPlaceHolder.height(menuH);
                    } else {
                        menu.removeClass('axil-sticky');
                        stickyPlaceHolder.height(0);
                    }
                }
            });
        },
        sideOffcanvasToggle: function (selectbtn, openElement) {

            $('body').on('click', selectbtn, function (e) {
                e.preventDefault();

                var $this = $(this),
                    wrapp = $this.parents('body'),
                    wrapMask = $('<div / >').addClass('closeMask'),
                    cartDropdown = $(openElement);

                if (!(cartDropdown).hasClass('open')) {
                    wrapp.addClass('open');
                    cartDropdown.addClass('open');
                    cartDropdown.parent().append(wrapMask);
                    wrapp.css({
                        'overflow': 'hidden'
                    });

                } else {
                    removeSideMenu();
                }

                function removeSideMenu() {
                    wrapp.removeAttr('style');
                    wrapp.removeClass('open').find('.closeMask').remove();
                    cartDropdown.removeClass('open');
                }

                $('.sidebar-close, .closeMask').on('click', function () {
                    removeSideMenu();
                });

            });
        },
    }
    pcvInit.i();
})

function pcvAjax(action, actionData, userVerifiedRequired = 0) {

    if (userVerifiedRequired) {
        if (pcv_vars.is_user_logged_in !== "1") {
            window.location.href = pcv_vars.login_url;
            return false;
        }

        if (pcv_vars.is_user_verified !== "1") {
            window.location.href = pcv_vars.profile_url;
            return false;
        }
    }

    let data = {
        'action': action, 'nonce': pcv_vars.nonce
    };

    for (const [key, value] of Object.entries(actionData)) {
        data[key] = value;
    }

    return jQuery.ajax({
        url: pcv_vars.ajaxurl,
        type: 'POST',
        data: data,
        success: function (data) {
            return data;
        },
        error: function (request, error) {
            console.log(request);
            console.log(error);
        }
    });
}