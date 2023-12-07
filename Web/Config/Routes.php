<?php

namespace Config;

if (file_exists(APPPATH . 'Routes/lcusers-web.php')) {
	require APPPATH . 'Routes/lcusers-web.php';
}else if (file_exists(ROOTPATH.'LcUsers/Web/Routes/lcusers-web.php')) {
	require ROOTPATH.'LcUsers/Web/Routes/lcusers-web.php';
}
