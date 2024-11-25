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

      $userId = $this->user_id();
      $this->loggedIn = !is_null($userId);
   }

   //--------------------------------------------------------------------
   public function checkPassword(string $password, $user_get_value = null, $user_get_field = 'id')
   {
      if ($user_get_value) {
         $userAuthData = $this->appuser_auth_model->asObject()
            ->select('id,user_id,type,id_app,username,token,last_used_at,secret')
            ->where($user_get_field, $user_get_value)
            ->where('secret !=', null)
            ->where('active', 1)
            ->first();
         if ($userAuthData) {
            if (password_verify($password, $userAuthData->secret)) {
               $loggedUserData = (object)[
                  'code' => 200,
                  'status' => 'found',
                  'data' => $userAuthData
               ];
               return $loggedUserData;
            }
         }
      }
      return false;
   }

   //--------------------------------------------------------------------
   public function login(array $credentials, $remember = null)
   {
      $userAuthData = $this->appuser_auth_model->asObject()
         ->select('id,user_id,type,id_app,username,token,last_used_at,secret')
         ->where('username', $credentials['email'])
         ->where('secret !=', null)
         ->where('active', 1)
         ->first();
      if ($userAuthData) {
         if (password_verify($credentials['password'], $userAuthData->secret)) {
            // 
            $update_data = [
               'last_used_at' => Time::now()->toLocalizedString('yyyy-MM-dd HH:mm:ss')
            ];
            $this->appuser_auth_model->update($userAuthData->id, $update_data);
            // 
            $userData = $this->appuser_data_model->asObject()->where('status!=', 0)->find($userAuthData->user_id);
            if ($userData) {
               $update_data = [
                  'last_active' => Time::now()->toLocalizedString('yyyy-MM-dd HH:mm:ss')
               ];
               $this->appuser_data_model->update($userData->id, $update_data);
               $loggedAppUserData = (object)[
                  'id' => $userData->id,
                  'auth_id' => $userAuthData->id,
                  'auth_user_id' => $userAuthData->user_id,
                  'token' => $userAuthData->token,
                  'username' => $userAuthData->username,
                  'login_type' => $userAuthData->type,
                  'nickname' => $userData->nickname,
                  'name' => $userData->name,
                  'surname' => $userData->surname,
                  'email' => $userData->email,
                  'status' => $userData->status,
                  'status_message' => $userData->status_message,
                  'role' => $userData->role,
                  'permissions_level' => $userData->permissions_level,
                  'last_active' => $userData->last_active,
                  'last_used_at' => $userAuthData->last_used_at,
               ];
               $loggedUserData = (object)[
                  'code' => 200,
                  'status' => 'found',
                  'data' => $loggedAppUserData
               ];
               $this->loggedIn = true;
               return $loggedUserData;
            }
         }
      }
      // }
      return false;
   }

   //--------------------------------------------------------------------
   public function loginPostAction($post_data): bool
   {

      $logged_user_data =  $this->login($post_data);
      if ($logged_user_data && $logged_user_data->code == 200 && $logged_user_data->data) {
         $this->setUserSession($logged_user_data->data);
         return TRUE;
      }
      //  }
      return FALSE;
   }

   //--------------------------------------------------------------------
   public function getActivationTokenData(string $tokenString)
   {
      $userAuthData = $this->appuser_auth_model->asObject()
         ->select('id,user_id,type,id_app,username,activation_token')
         ->where('activation_token', $tokenString)
         ->where('active', 0)
         ->first();
      if ($userAuthData) {
         $new_user_data = (object)[
            'code' => 200,
            'status' => 'found',
            'data' => $userAuthData
         ];
         return $new_user_data;
      }
      return false;
   }

   //--------------------------------------------------------------------
   public function activateAccount(object $tokenData)
   {
      $generatedToken = random_string('alnum', 8) . '-' . random_string('alnum', 16) . '-' . random_string('alnum', 8);
      $userAuth = $this->appuser_auth_model->find($tokenData->id);
      $userAuth->active = 1;
      $userAuth->activated_at =  Time::now()->toLocalizedString('yyyy-MM-dd HH:mm:ss');
      $userAuth->token = $generatedToken;
      $userAuth->activation_token = null;
      if ($this->appuser_auth_model->save($userAuth)) {
         $userData = $this->appuser_data_model->find($userAuth->user_id);
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
   public function updateUserData(array $post_data)
   {
      $user_id = $this->user_id();
      if ($user_id) {
         $userData = $this->appuser_data_model->find($user_id);
         $userData->fill($post_data);
         if ($userData->hasChanged()) {
            if ($this->appuser_data_model->save($userData)) {
               $new_user_data = (object)[
                  'code' => 200,
                  'status' => 'success',
                  'data' => $userData
               ];
               return $new_user_data;
            }
         }
      }
      return false;
   }

   //--------------------------------------------------------------------
   public function changeUserPassword($user_id, array $post_data)
   {
      if ($user_id) {
         $generatedToken = random_string('alnum', 8) . '-' . random_string('alnum', 16) . '-' . random_string('alnum', 8);
         $update_data = [];
         $update_data['secret'] = $post_data['new_password'];
         $update_data['token'] = $generatedToken;


         if ($this->appuser_auth_model->update($user_id, $update_data)) {
            $new_user_data = (object)[
               'code' => 200,
               'status' => 'success',
               'data' => 'Password aggiornata con successo'
            ];
            return $new_user_data;
         }
      }
      return false;
   }
   //--------------------------------------------------------------------
   public function register(array $post_data, $type = 'email_password')
   {
      $generatedActivationToken = random_string('alnum', 12) . '-' . random_string('alnum', 24) . '-' . random_string('alnum', 12) . '-' . random_string('alnum', 6);
      $post_data['username'] = $post_data['email'];
      $post_data['secret'] = $post_data['new_password'];
      $post_data['activation_token'] = $generatedActivationToken;
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
                  'activation_token' => $generatedActivationToken,
               ],
            ];
            return $new_user_data;
         }
      }
      return false;
   }

   //-------------------------------------------------
   public function logout()
   {
      session()->set(['app_user_data' => null]);
   }

   //-------------------------------------------------
   public function setUserSession(object $userData)
   {
      session()->set(['app_user_data' => $userData]);
   }

   //--------------------------------------------------------------------
   public function getAllUserData()
   {
      if ($curr_user_id = $this->getUserId()) {

         $allUserData = $this->appuser_data_model->asObject()->where('status!=', 0)->find($curr_user_id);
         if ($allUserData) {
            return $allUserData;
         }
      }
      return false;
   }

   //--------------------------------------------------------------------
   public function getUserData()
   {
      $app_user_data = session()->get('app_user_data');
      if ($app_user_data && $app_user_data->id) {
         if (intval($app_user_data->id) > 0) {
            return $app_user_data;
         }
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getLoggedIn(): bool
   {
      return $this->loggedIn;
   }

   //--------------------------------------------------------------------
   public function getUser()
   {
      return $this->getUserData();
   }

   //--------------------------------------------------------------------
   public function user_id()
   {
      if ($c_user_id = $this->getUserDataByKey('id')) {
         if (intval($c_user_id) > 0) {
            return intval($c_user_id);
         }
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserId()
   {
      if ($c_user_id = $this->getUserDataByKey('id')) {
         if (intval($c_user_id) > 0) {
            return intval($c_user_id);
         }
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getRole()
   {
      if ($user_role = $this->getUserDataByKey('role')) {
         if ($user_role) {
            return $user_role;
         }
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserWelcome()
   {
      if ($userFullName = $this->getUserFullName()) {
         return "Benvenuto" . ' ' . $userFullName;
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserFirstName()
   {
      if ($keyval = $this->getUserDataByKey('name')) {
         if ($keyval) {
            return $keyval;
         }
      }
      return null;
   }
   //--------------------------------------------------------------------
   public function getUserLastName()
   {
      if ($keyval = $this->getUserDataByKey('surname')) {
         if ($keyval) {
            return $keyval;
         }
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserFullName()
   {
      $fullname = '';
      if ($name_keyval = $this->getUserDataByKey('name')) {
         if ($name_keyval) {
            $fullname = $name_keyval;
         }
      }
      if ($surname_keyval = $this->getUserDataByKey('surname')) {
         if ($surname_keyval) {
            $fullname .= ((trim($fullname)) ? ' ' : '') . $surname_keyval;
         }
      }
      if (trim($fullname)) {
         return $fullname;
      }

      return null;
   }

   //--------------------------------------------------------------------
   public function getUserNickname()
   {
      if ($keyval = $this->getUserDataByKey('nickname')) {
         if ($keyval) {
            return $keyval;
         }
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserStatus()
   {
      if ($keyval = $this->getUserDataByKey('status')) {
         if ($keyval) {
            return $keyval;
         }
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserStatusMessage()
   {
      if ($keyval = $this->getUserDataByKey('status_message')) {
         if ($keyval) {
            return $keyval;
         }
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserToken()
   {
      if ($keyval = $this->getUserDataByKey('token')) {
         if ($keyval) {
            return $keyval;
         }
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserLoginType()
   {
      if ($keyval = $this->getUserDataByKey('login_type')) {
         if ($keyval) {
            return $keyval;
         }
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserAuthId()
   {
      if ($keyval = $this->getUserDataByKey('auth_id')) {
         if ($keyval) {
            return $keyval;
         }
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserAuthUserId()
   {
      if ($keyval = $this->getUserDataByKey('auth_user_id')) {
         if ($keyval) {
            return $keyval;
         }
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserAuthUsername()
   {
      if ($keyval = $this->getUserDataByKey('username')) {
         if ($keyval) {
            return $keyval;
         }
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserRole()
   {
      if ($keyval = $this->getUserDataByKey('role')) {
         if ($keyval) {
            return $keyval;
         }
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserPermissionsLevel()
   {
      if ($keyval = $this->getUserDataByKey('permissions_level')) {
         if ($keyval) {
            return $keyval;
         }
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getUsername()
   {
      if ($keyval = $this->getUserDataByKey('username')) {
         if ($keyval) {
            return $keyval;
         }
      }
      return null;
   }


   //--------------------------------------------------------------------
   public function getUserEmail()
   {
      if ($keyval = $this->getUserDataByKey('email')) {
         if ($keyval) {
            return $keyval;
         }
      }
      return null;
   }

   //--------------------------------------------------------------------
   public function getUserDataByKey($key)
   {
      if ($key && trim($key) && $__userdata = $this->getUserData()) {
         if (isset($__userdata->$key)) {
            return $__userdata->$key;
         }
      }
      return null;
   }


   //--------------------------------------------------------------------
   public function emailExist(string $email): bool
   {
      $exist = $this->appuser_data_model->select('id')
         ->where('email', $email)
         ->where('status', 1)
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
         ->first();
      if ($exist) {
         return true;
      }
      return false;
   }
}
