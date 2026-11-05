<?php

/*
=============================================================================
CUSTOM SETTINGS FOR THE THEME OPTIONS PANEL
=============================================================================

Add new settings to the theme options panel here.
Every array item is a new setting.

Available values for "type" setting: checkbox,select,text,textarea,color,image_upload
Available values for "label" setting: main,layout,menu,footer,lists,titles,customizations,social

$HC_CUSTOM_PANEL
name : Theme's name
version : Theme's version
colors : Theme's panel colors

Documentation: wordpress.framework-y.com/advanced-api-documentation/#custom-theme

 */

global $HC_CUSTOM_THEME_OPTIONS;
global $HC_CUSTOM_PANEL;

$HC_CUSTOM_FONT = "Droid+Serif:400i|Open+Sans:400,600,700,800";

$HC_CUSTOM_PANEL = array(
	'name'    => 'Elon',
	'version' => '1.4.6',
    'colors'  => array("#4c4c4c","#3c3c3c"),
    'demos' => array(array('id' => 'elon','name' => 'Main demo')),
    'demos_url' => 'http://themes.framework-y.com/demo-import/'
);

$HC_SITE_FONTS = 'body, .adv-img p, .caption-bottom p, .adv-circle .caption p, .advs-box p {
    font-family: [FONT-1] !important;
}
.font-2, .home-slider li p, .title-base p, .box-menu-inner .icon-box-cell p, .timeline-label, .pricing-table h3, .meta-header .date, .adv-img-down-text .caption-bottom p,
.tweets_txt span, .comment-list .name span, .tag-row a, .tag-row.icon-row span, .niche-box-team h4, .countdown .countdown-label, .niche-box-testimonails-cloud .name-box .subtitle .subtxt,
.adv-img-full-content p, .quote-author, .niche-box-testimonails > h5 span, .adv-img-classic-box .caption-inner p.sub-text {
    font-family: [FONT-2] !important;
}';

$HC_SITE_COLORS = '.dropdown-menu > li > a:before, .navbar-nav > li.dropdown > a:after, .nav-pills > li > a:hover, .fa-li, i.icon, .counter-inverse .icon-box-cell p,
i.square, i.circle, .niche-box-testimonails > h5 span, .timeline small, .comment-list .name span, a.collapse-button:hover,
li.panel-item .fa-li, .advs-box .btn, .advs-box .btn:hover, .social-group i.circle, .icon-list .list-item i,
.adv-img i, .accordion-list .list-group-item > a:hover, .side-menu > li.active > a > i, .navbar-default .navbar-nav > .active > a, .adv-img-full-content p.sub {
    color: [MAIN-COLOR];
}

.posts-list h6:before,.navbar-nav > li.active > a, header.bg-transparent .navbar-default .navbar-nav > li:hover > a,header .navbar-default .navbar-nav > li:hover > a,.navbar-default .navbar-nav > li:hover ,.pricing-table .pricing-price, .white-2 .quote-author, .white .icon-list-2 .list-item i, .list-group-item.pricing-price:hover, .advs-box-top-icon a, .advs-box-top-icon a:after, .nav-tabs > li:hover > a, .nav-tabs > li:hover > a i, .nav-tabs > li.active > a, .nav-tabs > li.active > a i, .list-group-item:not(.active):hover > a, .icon-menu .navbar-collapse ul.nav > li > a:hover i, header .btn-search:hover, .nav.ms-minimal > li.active > a, .icon-background.boxed-inverse:not(.bg-color) .i-background, .icon-box-cell > i, .dropdown.btn-group .active > a, .bootgrid-header .dropdown-item:hover, .white .box-side-icon-small .icon-box i, .btn-text:hover, .side-menu .active > a, .sidebar-nav a:hover, .sidebar-nav a:focus, .sidebar-nav a:active, .advs-box-top-icon .icon, .adv-img-full-content i.main-icon, .advs-box-multiple.boxed div i, .footer-minimal .footer-title, .white .text-color, .text-color, .btn-text i, .tag-row i, .pagination > .active > a, .pagination > li > a:hover, .datepicker-panel > ul > li:hover, .adv-img-button-content .caption i, .social-line .social-group i.circle:hover, .white .icon-box-cell > i.square, .white .icon-box-cell > i.circle {
    color: [MAIN-COLOR] !important;
}

.img-box.adv-img-half-content .caption,[class*="col-md-"].boxed, .fa-angle-up.scroll-top, .call-action-box, .ul-dots li:before, .flex-control-paging li a.flex-active, .flex-control-paging li a:hover, .progress-bar, .btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
    background-color: [MAIN-COLOR] !important;
}

.social-group i.circle, .social-button i.circle, .hamburger-button, .bg-color, .home-fullpage p, .home-fullpage a:hover, .timeline > li:hover > .timeline-badge, ul.side-menu li.active:before, #twosides-menu, .subline-bar, .accordion-list .list-group-item:before, .advs-box-multiple div.circle, .advs-box.boxed .advs-box-content, .advs-box.boxed, .box-social-page, .advs-box-top-icon-img .icon, .btn, .circle-button, header .btn, .navbar-inner .nav:not(.ms-rounded) li a:before, .white .btn, .timeline > li:hover > .timeline-badge {
    background-color: [MAIN-COLOR];
}

    .hamburger-button:hover,.popup-banner.full-width-top, .popup-banner.full-width-bottom, .one-page-menu .hamburger-button.active, .subline-bar li:hover, .navbar-default .navbar-toggle:hover, .navbar-default .navbar-toggle:focus, .btn:hover, header .btn:hover {
        background-color: [HOVER-COLOR] !important;
    }

div.adv-img-side-content .btn:hover, .nav-pills > li.active > a, .mega-menu .nav-tabs li.active, .list-items .list-item span, .timeline > li > .timeline-badge, div.adv-img-side-content .btn:hover i, .nav.inner.ms-rounded li a:hover, .nav.inner.ms-rounded li.active a, .datepicker-panel > ul > li.picked, .datepicker-panel > ul > li.picked:hover {
    border-color: [MAIN-COLOR] !important;
    color: [MAIN-COLOR] !important;
}

.tab-box > .panel, .tab-box > .panel-box > .panel, .niche-box-team .content-box hr, hr.e, .datepicker-top-left, .datepicker-top-right {
    border-top-color: [MAIN-COLOR] !important;
}

.tab-box.right .panel-box {
    border-right-color: [MAIN-COLOR] !important;
}

.tab-box.left .nav-tabs, .mi-menu .sidebar-nav, .tab-box.left .panel-box {
    border-left-color: [MAIN-COLOR] !important;
}

.accordion-list .list-group-item:hover, .list-items .list-item:hover, .title-modern h2, .tab-box.inverse .panel, .datepicker-top-left:before, .datepicker-top-right:before {
    border-bottom-color: [MAIN-COLOR] !important;
}


.white .quote-author, .white .icon-list .list-item i {
    color: [MAIN-COLOR-3];
}

.white .pagination > li > a:hover, .white .pagination > .active > a, .white.advs-box-blog .tag-row span:after,
.white.niche-box-post .tag-row i, .white.niche-box-post .tag-row span:after {
    color: [MAIN-COLOR] !important;
}

.white .btn:hover, .niche-box-post.boxed .block-infos,.input-group-btn:last-child > .btn:hover {
    border-color: [MAIN-COLOR] !important;
}

.white .load-more-maso:hover {
    color: [MAIN-COLOR] !important;
    border-color: [MAIN-COLOR] !important;
}

.header-slider .flex-control-paging li a.flex-active, .header-slider .flex-control-paging li a:hover {
    background-color: [MAIN-COLOR] !important;
}

.half-side.right {
    background: [MAIN-COLOR] !important;
}';


?>
