<?php

namespace LcUsers\Web\Controllers;


class Appuser extends \App\Controllers\BaseController
{
    protected $isLogged = false;
    

    private $req;


    //--------------------------------------------------------------------
    public function __construct()
    {
        $this->req = \Config\Services::request();

        // helper('lcusers');

        // parent::__construct();
    }

    public function user_id()
    {
       return null;
    }

    //--------------------------------------------------------------------
    // public function checkCartAction() //($category_guid = null)
    // {
    //     if ($this->req->getPost()) {
    //         if ($this->req->getPost('cart_action') == 'ADD') {
    //             if ($this->addToCart($this->req->getPost('prod_id'), 'p_')) {
    //                 return TRUE;
    //             }
    //         }
    //     }
    //     return FALSE;
    // }

    //-------------------------------------------------
    public function logout()
    {
        session()->set(['app_user_data' => null]);
    }
   
   



}
