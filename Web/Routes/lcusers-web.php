<?php

// $req = \Config\Services::request();
// if (!$req->isCLI()) {
// 	$uri = $req->getUri();
// 	$supportedLocales = config(App::class)->{'supportedLocales'};
// 	$supportedLocalesWithoutDefault = array_diff($supportedLocales, array($req->getDefaultLocale()));
// 	if (in_array($uri->getSegment(1), $supportedLocalesWithoutDefault)) {
// 		$routes->match(['get', 'post'], '{locale}/user', '\LcUsers\Web\Controllers\UserArea::index', ['as' => $uri->getSegment(1) . 'web_user_area']);
// 	} else {
// 	}
// }

// // $routes->match(['get', 'post'], '/payment-stripe-webhook', '\App\Controllers\App\Webhooks::paymentStripeWebhook', ['as' => 'payment_stripe_webhook']);


// $routes->match(['get', 'post'], 'user', '\LcUsers\Web\Controllers\UserArea::index', ['as' => 'web_user_area']);


$routes->match(['get', 'post'], 'login', '\LcUsers\Web\Controllers\User::login', ['as' => 'web_login', 'filter' => 'appGuestFilter']);
$routes->match(['get', 'post'], 'registrati', '\LcUsers\Web\Controllers\User::signUp', ['as' => 'web_signup', 'filter' => 'appGuestFilter']);
$routes->get( 'email-template/(:any)', '\LcUsers\Web\Controllers\User::vediEmailTemplate/$1');
$routes->match(['get', 'post'], 'recupera-password/(:any)', '\LcUsers\Web\Controllers\User::recuperaPasswordS1/$1', ['as' => 'web_recupera_password_s1_action', 'filter' => 'appGuestFilter']);
$routes->match(['get', 'post'], 'recupera-password', '\LcUsers\Web\Controllers\User::recuperaPasswordS1', ['as' => 'web_recupera_password_s1', 'filter' => 'appGuestFilter']);
$routes->match(['get', 'post'], 'crea-nuova-password/(:any)', '\LcUsers\Web\Controllers\User::recuperaPasswordS2/$1', ['as' => 'web_recupera_password_s2', 'filter' => 'appGuestFilter']);
$routes->match(['get'], 'attiva-account/(:any)', '\LcUsers\Web\Controllers\User::attivaAccount/$1', ['as' => 'web_attiva_account', 'filter' => 'appGuestFilter']);



$routes->group('user', ['namespace' => '\LcUsers\Web\Controllers', 'filter' => 'appUserFilter'], function ($routes) {
    $routes->match(['get'], 'logout', 'User::logout', ['as' => 'web_logout']);

    // $routes->group('user-settings', function ($routes) {
    //     // $routes->match(['get','post'], 'membership', 'UserSettings::membershipList', ['as' => 'web_user_settings_membership']);
    //     // $routes->match(['get', 'post'], 'profiles/(:num)', 'UserSettings::profilesEdit/$1', ['as' => 'web_user_settings_profile_edit']);
    //     // $routes->match(['get','post'], 'profiles/delete/(:num)', 'UserSettings::profilesDelete/$1', ['as' => 'web_user_settings_profile_delete']);
    //     // $routes->match(['get','post'], 'profiles', 'UserSettings::profilesList', ['as' => 'web_user_settings_profiles']);
    //     $routes->match(['get', 'post'], '/', 'UserSettings::userAccount', ['as' => 'web_user_settings_account']);
    // });
    // 
    $routes->match(['get','post'], 'profile/password', 'User::userChangePassword', ['as' => 'web_user_profile_password']);
    $routes->match(['get','post'], 'profile', 'User::userProfile', ['as' => 'web_user_profile']);
    $routes->match(['get','post'], 'dashboard', 'User::personalDashboard', ['as' => 'web_dashboard']);
    $routes->match(['get','post'], '/', 'User::personalDashboard', ['as' => 'web_user_area']);
});
// appGuestFilter