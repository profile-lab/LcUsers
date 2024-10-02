<?php
$req = \Config\Services::request();
if (!$req->isCLI()) {
    $uri = $req->getUri();
    $supportedLocales = config("APP")->{'supportedLocales'};
    $supportedLocalesWithoutDefault = array_diff($supportedLocales, array($req->getDefaultLocale()));
    if (in_array($uri->getSegment(1), $supportedLocalesWithoutDefault)) {
        // 
        $routes->match(['get', 'post'], '{locale}/login', '\LcUsers\Web\Controllers\User::login', ['as' => $uri->getSegment(1) . 'web_login', 'filter' => 'appGuestFilter']);
        $routes->match(['get', 'post'], '{locale}/registrati', '\LcUsers\Web\Controllers\User::signUp', ['as' => $uri->getSegment(1) . 'web_signup', 'filter' => 'appGuestFilter']);
        $routes->match(['get', 'post'], '{locale}/recupera-password/(:any)', '\LcUsers\Web\Controllers\User::recuperaPasswordS1/$1', ['as' => $uri->getSegment(1) . 'web_recupera_password_s1_action', 'filter' => 'appGuestFilter']);
        $routes->match(['get', 'post'], '{locale}/recupera-password', '\LcUsers\Web\Controllers\User::recuperaPasswordS1', ['as' => $uri->getSegment(1) . 'web_recupera_password_s1', 'filter' => 'appGuestFilter']);
        $routes->match(['get', 'post'], '{locale}/crea-nuova-password/(:any)', '\LcUsers\Web\Controllers\User::recuperaPasswordS2/$1', ['as' => $uri->getSegment(1) . 'web_recupera_password_s2', 'filter' => 'appGuestFilter']);
        $routes->match(['get'], '{locale}/attiva-account/(:any)', '\LcUsers\Web\Controllers\User::attivaAccount/$1', ['as' => $uri->getSegment(1) . 'web_attiva_account', 'filter' => 'appGuestFilter']);
        // 
        $routes->match(['get'], '{locale}/user/logout', '\LcUsers\Web\Controllers\User::logout', ['as' => $uri->getSegment(1) . 'web_logout', 'filter' => 'appUserFilter']);
        $routes->match(['get', 'post'], '{locale}/user/profile/password', '\LcUsers\Web\Controllers\User::userChangePassword', ['as' => $uri->getSegment(1) . 'web_user_profile_password', 'filter' => 'appUserFilter']);
        $routes->match(['get', 'post'], '{locale}/user/profile', '\LcUsers\Web\Controllers\User::userProfile', ['as' => $uri->getSegment(1) . 'web_user_profile', 'filter' => 'appUserFilter']);
        $routes->match(['get', 'post'], '{locale}/user/dashboard', '\LcUsers\Web\Controllers\User::personalDashboard', ['as' => $uri->getSegment(1) . 'web_dashboard', 'filter' => 'appUserFilter']);
        $routes->match(['get', 'post'], '{locale}/user/', '\LcUsers\Web\Controllers\User::personalDashboard', ['as' => $uri->getSegment(1) . 'web_user_area', 'filter' => 'appUserFilter']);
    }
}


$routes->match(['get', 'post'], 'login', '\LcUsers\Web\Controllers\User::login', ['as' => 'web_login', 'filter' => 'appGuestFilter']);
$routes->match(['get', 'post'], 'registrati', '\LcUsers\Web\Controllers\User::signUp', ['as' => 'web_signup', 'filter' => 'appGuestFilter']);
$routes->get('email-template/(:any)', '\LcUsers\Web\Controllers\User::vediEmailTemplate/$1');
$routes->match(['get', 'post'], 'recupera-password/(:any)', '\LcUsers\Web\Controllers\User::recuperaPasswordS1/$1', ['as' => 'web_recupera_password_s1_action', 'filter' => 'appGuestFilter']);
$routes->match(['get', 'post'], 'recupera-password', '\LcUsers\Web\Controllers\User::recuperaPasswordS1', ['as' => 'web_recupera_password_s1', 'filter' => 'appGuestFilter']);
$routes->match(['get', 'post'], 'crea-nuova-password/(:any)', '\LcUsers\Web\Controllers\User::recuperaPasswordS2/$1', ['as' => 'web_recupera_password_s2', 'filter' => 'appGuestFilter']);
$routes->match(['get'], 'attiva-account/(:any)', '\LcUsers\Web\Controllers\User::attivaAccount/$1', ['as' => 'web_attiva_account', 'filter' => 'appGuestFilter']);
// 
$routes->group('user', ['namespace' => '\LcUsers\Web\Controllers', 'filter' => 'appUserFilter'], function ($routes) {
    $routes->match(['get'], 'logout', 'User::logout', ['as' => 'web_logout']);
    $routes->match(['get', 'post'], 'profile/password', 'User::userChangePassword', ['as' => 'web_user_profile_password']);
    $routes->match(['get', 'post'], 'profile', 'User::userProfile', ['as' => 'web_user_profile']);
    $routes->match(['get', 'post'], 'dashboard', 'User::personalDashboard', ['as' => 'web_dashboard']);
    $routes->match(['get', 'post'], '/', 'User::personalDashboard', ['as' => 'web_user_area']);
});
// appGuestFilter