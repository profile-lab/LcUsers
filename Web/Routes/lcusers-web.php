<?php
$req = \Config\Services::request();
if (!$req->isCLI()) {
    $uri = $req->getUri();
    $supportedLocales = config("APP")->{'supportedLocales'};
    $supportedLocalesWithoutDefault = array_diff($supportedLocales, array($req->getDefaultLocale()));
    if (in_array($uri->getSegment(1), $supportedLocalesWithoutDefault)) {
        // 
        $routes->match(['GET', 'POST'], '{locale}/login', '\LcUsers\Web\Controllers\User::login', ['as' => $uri->getSegment(1) . 'web_login', 'filter' => 'appGuestFilter']);
        $routes->match(['GET', 'POST'], '{locale}/registrati', '\LcUsers\Web\Controllers\User::signUp', ['as' => $uri->getSegment(1) . 'web_signup', 'filter' => 'appGuestFilter']);
        $routes->match(['GET', 'POST'], '{locale}/recupera-password/(:any)', '\LcUsers\Web\Controllers\User::recuperaPasswordS1/$1', ['as' => $uri->getSegment(1) . 'web_recupera_password_s1_action', 'filter' => 'appGuestFilter']);
        $routes->match(['GET', 'POST'], '{locale}/recupera-password', '\LcUsers\Web\Controllers\User::recuperaPasswordS1', ['as' => $uri->getSegment(1) . 'web_recupera_password_s1', 'filter' => 'appGuestFilter']);
        $routes->match(['GET', 'POST'], '{locale}/crea-nuova-password/(:any)', '\LcUsers\Web\Controllers\User::recuperaPasswordS2/$1', ['as' => $uri->getSegment(1) . 'web_recupera_password_s2', 'filter' => 'appGuestFilter']);
        $routes->match(['GET'], '{locale}/attiva-account/(:any)', '\LcUsers\Web\Controllers\User::attivaAccount/$1', ['as' => $uri->getSegment(1) . 'web_attiva_account', 'filter' => 'appGuestFilter']);
        // 
        $routes->match(['GET'], '{locale}/user/logout', '\LcUsers\Web\Controllers\User::logout', ['as' => $uri->getSegment(1) . 'web_logout', 'filter' => 'appUserFilter']);
        $routes->match(['GET', 'POST'], '{locale}/user/profile/password', '\LcUsers\Web\Controllers\User::userChangePassword', ['as' => $uri->getSegment(1) . 'web_user_profile_password', 'filter' => 'appUserFilter']);
        $routes->match(['GET', 'POST'], '{locale}/user/profile', '\LcUsers\Web\Controllers\User::userProfile', ['as' => $uri->getSegment(1) . 'web_user_profile', 'filter' => 'appUserFilter']);
        $routes->match(['GET', 'POST'], '{locale}/user/dashboard', '\LcUsers\Web\Controllers\User::personalDashboard', ['as' => $uri->getSegment(1) . 'web_dashboard', 'filter' => 'appUserFilter']);
        $routes->match(['GET', 'POST'], '{locale}/user/', '\LcUsers\Web\Controllers\User::personalDashboard', ['as' => $uri->getSegment(1) . 'web_user_area', 'filter' => 'appUserFilter']);
    }
}


$routes->match(['GET', 'POST'], 'login', '\LcUsers\Web\Controllers\User::login', ['as' => 'web_login', 'filter' => 'appGuestFilter']);
$routes->match(['GET', 'POST'], 'registrati', '\LcUsers\Web\Controllers\User::signUp', ['as' => 'web_signup', 'filter' => 'appGuestFilter']);
$routes->get('email-template/(:any)', '\LcUsers\Web\Controllers\User::vediEmailTemplate/$1');
$routes->match(['GET', 'POST'], 'recupera-password/(:any)', '\LcUsers\Web\Controllers\User::recuperaPasswordS1/$1', ['as' => 'web_recupera_password_s1_action', 'filter' => 'appGuestFilter']);
$routes->match(['GET', 'POST'], 'recupera-password', '\LcUsers\Web\Controllers\User::recuperaPasswordS1', ['as' => 'web_recupera_password_s1', 'filter' => 'appGuestFilter']);
$routes->match(['GET', 'POST'], 'crea-nuova-password/(:any)', '\LcUsers\Web\Controllers\User::recuperaPasswordS2/$1', ['as' => 'web_recupera_password_s2', 'filter' => 'appGuestFilter']);
$routes->match(['GET'], 'attiva-account/(:any)', '\LcUsers\Web\Controllers\User::attivaAccount/$1', ['as' => 'web_attiva_account', 'filter' => 'appGuestFilter']);
// 
$routes->group('user', ['namespace' => '\LcUsers\Web\Controllers', 'filter' => 'appUserFilter'], function ($routes) {
    $routes->match(['GET'], 'logout', 'User::logout', ['as' => 'web_logout']);
    $routes->match(['GET', 'POST'], 'profile/password', 'User::userChangePassword', ['as' => 'web_user_profile_password']);
    $routes->match(['GET', 'POST'], 'profile', 'User::userProfile', ['as' => 'web_user_profile']);
    $routes->match(['GET', 'POST'], 'dashboard', 'User::personalDashboard', ['as' => 'web_dashboard']);
    $routes->match(['GET', 'POST'], '/', 'User::personalDashboard', ['as' => 'web_user_area']);
});
// appGuestFilter