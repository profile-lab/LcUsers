<?php

namespace Config;

if (file_exists(APPPATH . 'Routes/lcuser-admin.php')) {
    require APPPATH . 'Routes/lcuser-admin.php';
} else if (file_exists(ROOTPATH . 'LcUsers/Cms/Routes/lcuser-admin.php')) {
    require ROOTPATH . 'LcUsers/Cms/Routes/lcuser-admin.php';
}
