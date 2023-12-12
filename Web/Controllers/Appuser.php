<?php

namespace LcUsers\Web\Controllers;

use CodeIgniter\I18n\Time;
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
      $this->appuser_auth_entity = new AppUsersAuth();
      $this->appuser_data_model = new AppUsersDatasModel();
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
   public function login(array $credentials, $remember = null)
   {
      return null;
   }

   //--------------------------------------------------------------------
   public function getActivationTokenData(string $tokenString)
   {
      $userAuthData = $this->appuser_auth_model->asObject()
         ->select('id,user_id,type,id_app,username,activation_token')
         ->where('activation_token', $tokenString)->where('active', 0)->first();
      if ($userAuthData) {
         $new_user_data = (object)[
            'code' => 200,
            'status' => 'found',
            'data' => $userAuthData
         ];
         return $new_user_data;
      }
      // }
      return false;
   }
   //--------------------------------------------------------------------
   public function activateAccount(object $tokenData)
   {
      $userAuth = $this->appuser_auth_model->find($tokenData->id);
      $userAuth->active = 1;
      $userAuth->activated_at =  Time::now()->toLocalizedString('yyyy-MM-dd HH:mm:ss');
      $userAuth->activation_token = null;
      if ($this->appuser_auth_model->save($userAuth)) {
         $userData= $this->appuser_data_model->find($userAuth->user_id);
         $userData->status = 1;
         $userData->status_message = 'active';
         if ($this->appuser_data_model->save($userData)) {
            $new_user_data = (object)[
               'code' => 200,
               'status' => 'success',
               'data' => $userAuth
            ];
            return $new_user_data;
         }
      }
      
      return false;
   }

   //--------------------------------------------------------------------
   public function register(array $post_data, $type = 'email_password')
   {
      $generatedToken = random_string('alnum', 12) . '-' . random_string('alnum', 24) . '-' . random_string('alnum', 12) . '-' . random_string('alnum', 6);
      $post_data['username'] = $post_data['email'];
      $post_data['password'] = $post_data['new_password'];
      $post_data['activation_token'] = $generatedToken;


      $this->appuser_data_entity->fill($post_data);
      if ($this->appuser_data_model->save($this->appuser_data_entity)) {

         $new_id = $this->appuser_data_model->getInsertID();
         // 
         $this->appuser_auth_entity->fill($post_data);
         $this->appuser_auth_entity->user_id = $new_id;
         $this->appuser_auth_entity->type = $type;
         if ($this->appuser_auth_model->save($this->appuser_auth_entity)) {
            $new_user_data = (object)[
               'code' => 201,
               'status' => 'success',
               'data' => (object)[
                  'id' => $new_id,
                  'name' => $this->appuser_data_entity->name,
                  'surname' => $this->appuser_data_entity->surname,
                  'username' => $this->appuser_data_entity->username,
                  'email' => $this->appuser_data_entity->email,
                  'activation_token' => $generatedToken,
               ],
            ];
            return $new_user_data;
         }
      }
      return false;
   }

   //--------------------------------------------------------------------
   public function emailExist(string $email): bool
   {
      $exist = $this->appuser_data_model->select('id')
         ->where('email', $email)
         ->where('status', 1)
         // ->where('id_app', 1)
         ->first();
      if ($exist) {
         return true;
      }
      return false;
   }
   //--------------------------------------------------------------------
   public function usernameExist(string $username): bool
   {
      $exist = $this->appuser_auth_model->select('id')
         ->where('username', $username)
         ->where('active', 1)
         // ->where('id_app', 1)
         ->first();
      if ($exist) {
         return true;
      }
      return false;
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
