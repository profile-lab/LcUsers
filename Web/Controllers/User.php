<?php

namespace LcUsers\Web\Controllers;

use Lc5\Data\Models\PagesModel;


use Config\Services;

use stdClass;

class User extends \Lc5\Web\Controllers\MasterWeb
{
    protected $LcUsers_views_namespace = '\LcUsers\Web\Views/';

    protected $appuser;

    //--------------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        // dd('User.php');
        // 
        $this->web_ui_date->__set('request',$this->req);

        $this->appuser = Services::appuser();

        // 

        // 


    }


    //--------------------------------------------------------------------
    public function login()
    {

        //
		if (appIsFile($this->base_view_filesystem . 'users/login.php')) {
			$this->web_ui_date->__set('master_view', 'user-login');
			return view($this->base_view_namespace . 'users/login', $this->web_ui_date->toArray());
		}else{
			$this->web_ui_date->__set('master_view', 'user-login-default');
			$this->web_ui_date->__set('base_view_folder', $this->base_view_namespace);
			return view($this->LcUsers_views_namespace.'login', $this->web_ui_date->toArray());
		}
    }
    //--------------------------------------------------------------------
    public function signUp()
    {
        

        //
		if (appIsFile($this->base_view_filesystem . 'users/signup.php')) {
			$this->web_ui_date->__set('master_view', 'user-signup');
			return view($this->base_view_namespace . 'users/signup', $this->web_ui_date->toArray());
		}else{
			$this->web_ui_date->__set('master_view', 'user-signup-default');
			$this->web_ui_date->__set('base_view_folder', $this->base_view_namespace);
			return view($this->LcUsers_views_namespace.'signup', $this->web_ui_date->toArray());
		}
    }
    
    //--------------------------------------------------------------------
    public function personalDashboard()
    {
    }


    //--------------------------------------------------------------------
    public function index()
    {

        // if ($this->cart->checkCartAction()) {
        //     return redirect()->to(site_url(uri_string()));
        // }
       

        // return view($this->base_view_namespace . 'shop/archive', $this->web_ui_date->toArray());
    }

    
}
