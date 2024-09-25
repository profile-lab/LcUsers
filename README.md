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

Add appuser services in App\Config\Services.php


        //--------------------------------------------------------------------
        public static function appuser($getShared = true)
        {
                if ($getShared) {
                return static::getSharedInstance('appuser');
                }
                return new \LcUsers\Web\Controllers\Appuser();
        }

## Base Controller 

Add helpers requirements in App\Controllers\BaseController.php

        protected $helpers = [... 'lcusers_frontend', 'lcusers_backend'];



### App Filter 

Add app users filter alias in App\Config\Filters.php

        public array $aliases = [
           ...
           'appUserFilter' => \LcUsers\Web\Filters\AppAuthUserFilter::class,
           'appGuestFilter' => \LcUsers\Web\Filters\AppGuestFilter::class,


        ]

## Site Header 

### Add css Link Tag  App\Views\layout\components\header-tag.php

        <link rel="stylesheet" href="<?= __base_assets_folder__.'lc-admin-assets/frontend/users-fe-base.css' ?>" />
