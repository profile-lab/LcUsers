<?php

namespace LcUsers\Cms\Controllers;


class LcUsersConfigs
{

    //--------------------------------------------------------------------
    public static function getLcModulesMenu(): array
    {
        $mudules = [];
        $mudules['lcusers'] = (object) [
            'label' => 'Shop',
            'route' => 'lc_users',
            'module' => 'lcusers',
            'ico' => 'basket',
            'items' => [
                (object) [
                    'label' => 'Lista Prodotti',
                    'route' => 'lc_users_prod',
                    // 'route' => site_url(route_to('lc_users_prod')),
                    'module_action' => 'index',
                ],
                (object) [
                    'label' => 'Nuovo Prodotto',
                    'route' => 'lc_users_prod_new',
                    // 'route' => site_url(route_to('lc_users_prod_new')),
                    'module_action' => 'newpost',
                ],
                (object) [
                    'label' => 'Categorie Prodotti',
                    'route' => 'lc_users_prod_cat',
                    // 'route' => site_url(route_to('lc_users_prod_cat')),
                    'module_action' => 'shopproductscat',
                ],
                (object) [
                    'label' => 'Settings',
                    'route' => 'lc_users_settings',
                    // 'route' => site_url(route_to('lc_users_settings')),
                    'module_action' => 'shopsettings',
                ],

            ]
        ];

        return $mudules;




    }


    //--------------------------------------------------------------------
    public static function getShopToolsTabs()
    {
        $tabs_data_arr = [
            (object) [
                'label' => 'Config',
                'route' => site_url(route_to('lc_users_settings')),
                'module_tab' => 'shopsettings',
            ],
            (object) [
                'label' => 'Taglie Prodotti',
                'route' => site_url(route_to('lc_users_prod_sizes')),
                'module_tab' => 'shopproductssizes',
            ],
            (object) [
                'label' => 'Varianti Prodotti',
                'route' => site_url(route_to('lc_users_prod_colors')),
                'module_tab' => 'shopproductscolors',
            ],
            (object) [
                'label' => 'Tags Prodotti',
                'route' => site_url(route_to('lc_users_prod_tags')),
                'module_tab' => 'shopproductstags',
            ],
            (object) [
                'label' => 'Spese Spedizione',
                'route' => site_url(route_to('lc_users_spese_spedizione')),
                'module_tab' => 'speesespedizione',
            ],
            (object) [
                'label' => 'Aliquote Iva',
                'route' => site_url(route_to('lc_users_aliquote')),
                'module_tab' => 'shopaliquote',
            ]
        ];

        return $tabs_data_arr;
    }
}
