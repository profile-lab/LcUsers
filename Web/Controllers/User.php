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
       
        $this->appuser = Services::appuser();
        // 

        // 


    }


    //--------------------------------------------------------------------
    public function login()
    {
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
