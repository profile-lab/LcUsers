<?php

namespace Config;

if (file_exists(APPPATH . 'Routes/lcusers-admin.php')) {
    require APPPATH . 'Routes/lcusers-admin.php';
} else if (file_exists(ROOTPATH . 'LcUsers/Cms/Routes/lcusers-admin.php')) {
    require ROOTPATH . 'LcUsers/Cms/Routes/lcusers-admin.php';
}