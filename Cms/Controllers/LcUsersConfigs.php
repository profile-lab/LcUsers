<?php

namespace LcUsers\Cms\Controllers;


class LcUsersConfigs
{

    //--------------------------------------------------------------------
    public static function getLcModulesMenu(): array
    {
        $mudules = [];
        $mudules['lcusers'] = (object) [
            'label' => 'Utenti',
            'route' => 'lc_site_users',
            'module' => 'lcusers',
            'ico' => 'people',
            // 'items' => [
            //     (object) [
            //         'label' => 'Lista Utenti',
            //         'route' => 'lc_site_users',
            //         // 'route' => site_url(route_to('lc_site_users')),
            //         'module_action' => 'index',
            //     ],
            //     (object) [
            //         'label' => 'Nuovo Utente',
            //         'route' => 'lc_site_users_new',
            //         // 'route' => site_url(route_to('lc_site_users_new')),
            //         'module_action' => 'newpost',
            //     ]
            // ]
        ];
        return $mudules;
    }


    //--------------------------------------------------------------------
    public static function getLcUsersToolsTabs()
    {
        $tabs_data_arr = [];
        return $tabs_data_arr;
    }
}
