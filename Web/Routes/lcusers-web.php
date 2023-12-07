<?php

$req = \Config\Services::request();
if (!$req->isCLI()) {
	$uri = $req->getUri();
	$supportedLocales = config(App::class)->{'supportedLocales'};
	$supportedLocalesWithoutDefault = array_diff($supportedLocales, array($req->getDefaultLocale()));
	if (in_array($uri->getSegment(1), $supportedLocalesWithoutDefault)) {
		$routes->match(['get', 'post'], '{locale}/user', '\LcUsers\Web\Controllers\UserArea::index', ['as' => $uri->getSegment(1) . 'web_user_area']);
	} else {
	}
}

// $routes->match(['get', 'post'], '/payment-stripe-webhook', '\App\Controllers\App\Webhooks::paymentStripeWebhook', ['as' => 'payment_stripe_webhook']);


$routes->match(['get', 'post'], 'user', '\LcUsers\Web\Controllers\UserArea::index', ['as' => 'web_user_area']);
