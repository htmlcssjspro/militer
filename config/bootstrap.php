<?php

//* Directories for PHP
define('_ROOT_', dirname(__DIR__));
define('ADMIN',          _ROOT_ . '/Admin');
define('CONTROLLERS',    _ROOT_ . '/App/Controllers');
define('MODELS',         _ROOT_ . '/App/Models');
define('VIEWS',          _ROOT_ . '/App/Views');
define('ERROR_LOG_FILE', _ROOT_ . '/log/errors.log');

define('_PUBLIC_',       _ROOT_ . '/public');
define('PAGE_404',       _PUBLIC_ . '/404.php');

//* Directories for pages & ajax
define('UPLOADS', '/public/uploads');

define('API',  '/api/v1');


//* MAIN
define('MAIN_LAYOUT', VIEWS . '/layouts/layoutDefault.php');
define('MAIN_HEADER', VIEWS . '/components/header.php');
define('MAIN_FOOTER', VIEWS . '/components/footer.php');
define('MAIN_ASIDE',  VIEWS . '/components/aside.php');

define('MAIN_CSS', '/public/css/main.css');
define('MAIN_JS',  '/public/js/main.js');

define('MAIN_HOME',    VIEWS . '/pages/homePage.php');
define('MAIN_HOME_ID', 'home');

define('MAIN_TARIFFS',    VIEWS . '/pages/tariffs.php');
define('MAIN_TARIFFS_ID', 'tariffs');
define('MAIN_FAQ',    VIEWS . '/pages/faq.php');
define('MAIN_FAQ_ID', 'faq');
define('MAIN_INFO',    VIEWS . '/pages/info.php');
define('MAIN_INFO_ID', 'info');
define('MAIN_GUEST',   VIEWS . '/pages/guest.php');
define('MAIN_GUEST_ID', 'guest');
define('MAIN_USER',    VIEWS . '/pages/user.php');
define('MAIN_USER_ID', 'user');
define('MAIN_OFFERS',  VIEWS . '/pages/offers.php');
define('MAIN_OFFERS_ID', 'offers');
define('MAIN_OFFER',    VIEWS . '/pages/offer.php');
define('MAIN_OFFER_ID', 'offer');
define('MAIN_VIP_OFFERS',    VIEWS . '/pages/vipOffers.php');
define('MAIN_VIP_OFFERS_ID', 'vipoffers');


//* Includes
define('INCLUDE_OFFERS_LIST', VIEWS . '/includes/offersList.php');
define('INCLUDE_ORGANIZATOR_OFFERS_LIST', VIEWS . '/includes/organizatorOffersList.php');
define('INCLUDE_NEW_OFFER', VIEWS . '/includes/newOffer.php');
define('INCLUDES_ORDERS_LIST', VIEWS . '/includes/ordersList.php');
define('INCLUDE_ORDERS_LIST', VIEWS . '/includes/ordersList.php');
define('INCLUDE_USER_PROFILE', VIEWS . '/includes/userProfile.php');

//* Sections
define('SECTION_ACCESS', VIEWS . '/sections/access.php');


//* ADMIN
define('ADMIN_LAYOUT',     VIEWS . '/admin/layouts/AdminLayout.php');
define('ADMIN_HEADER',     VIEWS . '/admin/components/header.php');
define('ADMIN_FOOTER',     VIEWS . '/admin/components/footer.php');
define('ADMIN_ASIDE',      VIEWS . '/admin/components/aside.php');

define('ADMIN_CSS', '/public/css/admin/admin.css');
define('ADMIN_JS',  '/public/js/admin.js');

define('ADMIN_LOGIN',          VIEWS . '/admin/layouts/login.php');
define('ADMIN_LOGIN_ID',       'admin_login');

define('ADMIN_HOME',          VIEWS . '/admin/pages/homePage.php');
define('ADMIN_HOME_ID',       'admin_home');
define('ADMIN_PAGES',         VIEWS . '/admin/pages/pages.php');
define('ADMIN_PAGES_ID',      'admin_pages');
define('ADMIN_CURRENCY',      VIEWS . '/admin/pages/currency.php');
define('ADMIN_CURRENCY_ID',  'admin_currency');
define('ADMIN_OFFERS',        VIEWS . '/admin/pages/offers.php');
define('ADMIN_OFFERS_ID',     'admin_offers');
define('ADMIN_USERS_LIST',    VIEWS . '/admin/pages/usersList.php');
define('ADMIN_USERS_LIST_ID', 'admin_users_list');
define('ADMIN_TOWNS',         VIEWS . '/admin/pages/towns.php');
define('ADMIN_TOWNS_ID',      'admin_towns');
define('ADMIN_COUNTRIES',     VIEWS . '/admin/pages/countries.php');
define('ADMIN_COUNTRIES_ID',  'admin_countries');

define('ADMIN_PREFERENCES',    VIEWS . '/admin/pages/preferences.php');
define('ADMIN_PREFERENCES_ID', 'admin_preferences');


//* Status
define('STATUS_DEVELOPER',   'developer');
define('STATUS_ADMIN',       'admin');
define('STATUS_ORGANIZATOR', 'organizator');
define('STATUS_USER',        'user');
define('STATUS_GUEST',       'guest');


//* DB TABLES
define('SITEMAP_TABLE',       'sitemap');
define('USERS_TABLE',         'users');
define('OFFERS_TABLE',        'offers');
define('CURRENCY_TABLE',      'currency');
define('DELIVERY_COST_TABLE', 'delivery_cost');
define('ORGANIZATORS_TABLE',  'organizators');
define('ORDERS_TABLE',        'orders');
define('TOWNS_TABLE',         'towns');
define('COUNTRIES_TABLE',     'countries');
define('VIP_OFFERS_TABLE',    'vipoffers');
define('VIP_ORDERS_TABLE',    'viporders');

define('ADMIN_TABLE',    'admin');


//* UUID names
define('USER_UUID',  'user_uuid');
define('OFFER_UUID', 'offer_uuid');


define('DEV', true); // Установить в false на production
// DEV ? error_reporting(E_ALL) : error_reporting(0);

if (DEV) {
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    ini_set('error_reporting', -1);
    error_reporting(E_ALL);
    require _ROOT_ . '/dev/devHelper.php';
} else {
    error_reporting(0);
}
