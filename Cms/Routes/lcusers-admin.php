<?php
//----------------------------------------------------------------------------
//------------------- LC Shop
//----------------------------------------------------------------------------

if (env('custom.hide_lc_cms') === TRUE) {
} else {

	$routes->group('lc-admin', ['namespace' => 'LcUsers\Cms\Controllers', 'filter' => 'admin_auth'], function ($routes) {
		$routes->group('site-users', function ($routes) {
			$routes->get('delete/(:num)', 'SiteUsers::delete/$1', ['as' => 'lc_site_users_delete']);
			$routes->match(['GET', 'POST'], 'edit/(:num)', 'SiteUsers::edit/$1', ['as' => 'lc_site_users_edit']);
			$routes->match(['GET', 'POST'], 'newpost', 'SiteUsers::newpost', ['as' => 'lc_site_users_new']);
			$routes->get('', 'SiteUsers::index', ['as' => 'lc_site_users']);
		});
		
		// $routes->group('shop', function ($routes) {
		// 	$routes->group('products', function ($routes) {
		// 		$routes->get('delete/(:num)', 'ShopProducts::delete/$1', ['as' => 'lc_shop_prod_delete']);
		// 		$routes->match(['GET', 'POST'], 'edit/(:num)', 'ShopProducts::edit/$1', ['as' => 'lc_shop_prod_edit']);
		// 		$routes->match(['GET', 'POST'], 'newpost/(:num)', 'ShopProducts::newpost/$1', ['as' => 'lc_shop_prod_new_sub']);
		// 		$routes->match(['GET', 'POST'], 'newpost', 'ShopProducts::newpost', ['as' => 'lc_shop_prod_new']);
		// 		$routes->get('', 'ShopProducts::index', ['as' => 'lc_shop_prod']);
		// 	});
			
		// });
	});
}



//----------------------------------------------------------------------------
//------------------- FINE LC Shop
//----------------------------------------------------------------------------
