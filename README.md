# Levelcomplete 5 Corebase Module


## Install git submodule

        git submodule add https://github.com/profile-lab/LcUsers
        OR 
        git submodule add https://github.com/profile-lab/LcUsers <destination folder>

## Update/Download submodules
        
        git submodule update --init --recursive

## Base Configuration and Namespaces


Add LC5 psr4 namespace in App\Config\Autoload.php
        
        public $psr4 = [
                ...
                'LcUsers\Cms'   => ROOTPATH . 'LcUsers/Cms',
                'LcUsers\Data'   => ROOTPATH . 'LcUsers/Data',
                'LcUsers\Web'   => ROOTPATH . 'LcUsers/Web',
        ];


## App Services

Add LcUsers and Siteuser services in App\Config\Services.php


        //--------------------------------------------------------------------
        public static function users($getShared = true)
        {
                if ($getShared) {
                        return static::getSharedInstance('users');
                }
                return new \Lc5\Web\Controllers\Users\UserTools();
        }

        //--------------------------------------------------------------------
        public static function shopcart($getShared = true)
        {
                if ($getShared) {
                        return static::getSharedInstance('shopcart');
                }
                return new \LcUsers\Web\Controllers\Cart();
        }

## Base Controller 

Add helpers requirements in App\Controllers\BaseController.php

        protected $helpers = [... 'lcshop_frontend'];

Add getShopSettings method in App\Controllers\BaseController.php

       //--------------------------------------------------------------------
        protected function getShopSettings($current_app_id)
        {
                if(!$current_app_id){
                        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
                if (class_exists('\LcUsers\Data\Models\ShopSettingsModel')) {
                        // 
                        $shop_settings_model = new \LcUsers\Data\Models\ShopSettingsModel();
                        if (!$shop_settings_entity = $shop_settings_model->asObject()->where('id_app', $current_app_id)->first()) {
                                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                        }
                        // 
                        return $shop_settings_entity;
                }
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        }
