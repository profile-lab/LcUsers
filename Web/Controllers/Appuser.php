<?php

namespace LcUsers\Web\Controllers;

use LcUsers\Data\Entities\AppUsersAuth;
use LcUsers\Data\Entities\AppUsersData;
use LcUsers\Data\Models\AppUsersAuthsModel;
use LcUsers\Data\Models\AppUsersDatasModel;


class Appuser extends \App\Controllers\BaseController
{
   protected $loggedIn = false;

   private $appuser_auth_model;
   private $appuser_data_model;
   private $appuser_data_entity;
   private $appuser_auth_entity;

   private $req;


   //--------------------------------------------------------------------
   public function __construct()
   {
      $this->req = \Config\Services::request();
      // 
      $this->appuser_auth_model = new AppUsersAuthsModel();
      $this->appuser_data_model = new AppUsersDatasModel();
      $this->appuser_auth_entity = new AppUsersAuth();
      $this->appuser_data_entity = new AppUsersData();
      // helper('lcusers');

      // parent::__construct();
   }

   //--------------------------------------------------------------------
   public function user_id()
   {
      if ($userID = session()->get('user_id')) {
         return  intval($userID);
      }
      return null;
   }
  
   //--------------------------------------------------------------------
   public function login( array $credentials, $remember = null)
   {
      return null;
   }
   
   //--------------------------------------------------------------------
   public function register( array $post_data)
   {
      return null;
   }

   //--------------------------------------------------------------------
   public function getRole()
   {
      return null;
   }

   //--------------------------------------------------------------------
   public function getLoggedIn()
   {
      return null;
   }

   //--------------------------------------------------------------------
   public function getUser()
   {
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserName()
   {
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserEmail()
   {
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserData()
   {
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserDataByKey($key)
   {
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserDataByKeys($keys)
   {
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserDataByKeysArray($keys)
   {
      return null;
   }

   //--------------------------------------------------------------------
   public function check(array $credentials)
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
