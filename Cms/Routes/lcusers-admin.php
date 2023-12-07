<?php
//----------------------------------------------------------------------------
//------------------- LC Shop
//----------------------------------------------------------------------------

if (env('custom.hide_lc_cms') === TRUE) {
} else {

	$routes->group('lc-admin', ['namespace' => 'LcUsers\Cms\Controllers', 'filter' => 'admin_auth'], function ($routes) {
		$routes->group('shop', function ($routes) {
			$routes->group('products', function ($routes) {
				$routes->get('delete/(:num)', 'ShopProducts::delete/$1', ['as' => 'lc_shop_prod_delete']);
				$routes->match(['get', 'post'], 'edit/(:num)', 'ShopProducts::edit/$1', ['as' => 'lc_shop_prod_edit']);
				$routes->match(['get', 'post'], 'newpost/(:num)', 'ShopProducts::newpost/$1', ['as' => 'lc_shop_prod_new_sub']);
				$routes->match(['get', 'post'], 'newpost', 'ShopProducts::newpost', ['as' => 'lc_shop_prod_new']);
				$routes->get('', 'ShopProducts::index', ['as' => 'lc_shop_prod']);
			});
			
		});
	});
}



//----------------------------------------------------------------------------
//------------------- FINE LC Shop
//----------------------------------------------------------------------------
