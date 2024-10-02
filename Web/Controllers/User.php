<?php

namespace LcUsers\Web\Controllers;

use Lc5\Data\Models\PagesModel;


use Config\Services;
use LcUsers\Data\Models\AppUsersDatasModel;
use stdClass;

class User extends \Lc5\Web\Controllers\MasterWeb
{
    protected $LcUsers_views_namespace = '\LcUsers\Web\Views/';

    protected $appuser;

    //--------------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
        // 
        $this->web_ui_date->__set('request', $this->req);
        $this->appuser = Services::appuser();
        $this->web_ui_date->__set('user_welcome', $this->appuser->getUserWelcome());
        // 
    }


    //--------------------------------------------------------------------
    public function logout()
    {
        $this->appuser->logout();
        return redirect()->route('web_login');
    }


    //--------------------------------------------------------------------
    public function login()
    {
        if ($this->request->getPost()) {
            $post_data = $this->request->getPost();
            if ($this->appuser->loginPostAction($post_data)) {
                // if ($get_redirect = $this->request->getGet('returnTo', false)) {
                //     return redirect()->to(urldecode($get_redirect));
                // } else {
                //     return redirect()->route('web_dashboard');
                // }
                return redirect()->route('web_dashboard');
            } else {
                session()->setFlashdata('ui_mess', 'Nome utente o password errati');
                session()->setFlashdata('ui_mess_type', 'alert alert-danger');
            }
        }
        $pages_model = new PagesModel();
        $pages_model->setForFrontemd();
        if ($curr_entity = $pages_model->asObject()->orderBy('id', 'DESC')->where('guid', 'login')->first()) {
            $pages_entity_rows = $this->getEntityRows($curr_entity->id, 'pages');
            $this->web_ui_date->entity_rows = $pages_entity_rows;
        } else {
            $curr_entity = new stdClass();
            $curr_entity->titolo = 'Login';
            $curr_entity->guid = 'login';
            $curr_entity->testo = '';
            $curr_entity->seo_title = 'Login';
            $curr_entity->seo_description = '';
        }
        // 
        $this->web_ui_date->fill((array)$curr_entity);
        //
        $this->web_ui_date->__set('master_view', 'user-login');
        return view(customOrDefaultViewFragment('users/login', 'LcUsers'), $this->web_ui_date->toArray());
    }

    //--------------------------------------------------------------------
    public function signUp()
    {
        $curr_entity = new stdClass();
        if ($this->signUpAction()) {
            return redirect()->route('web_login');
        }
        // 
        $pages_model = new PagesModel();
        $pages_model->setForFrontemd();
        if ($curr_entity = $pages_model->asObject()->orderBy('id', 'DESC')->where('guid', 'signup')->first()) {
            $pages_entity_rows = $this->getEntityRows($curr_entity->id, 'pages');
            $this->web_ui_date->entity_rows = $pages_entity_rows;
        } else {
            $curr_entity = new stdClass();
            $curr_entity->titolo = 'Registrati';
            $curr_entity->guid = 'signup';
            $curr_entity->testo = '';
            $curr_entity->seo_title = 'Signup';
            $curr_entity->seo_description = '';
        }
        // 
        $this->web_ui_date->fill((array)$curr_entity);
        //

        //
        $this->web_ui_date->__set('master_view', 'user-signup');
        return view(customOrDefaultViewFragment('users/signup', 'LcUsers'), $this->web_ui_date->toArray());
    }

    //--------------------------------------------------------------------
    protected function signUpAction()
    {
        helper('text');
        // 
        $validate_rules = [
            // 'name' => ['label' => 'Nome', 'rules' => 'required'],
            // 'surname' => ['label' => 'Cognome', 'rules' => 'required'],
            'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
            'new_password' => ['label' => 'Password', 'rules' => 'required|min_length[8]'],
            'confirm_new_password' => ['label' => 'Conferma Password', 'rules' => 'required|matches[new_password]'],
            't_e_c' => ['label' => 'Termini e condizioni', 'rules' => 'required'],
        ];
        // 
        if (defined('SIGNUP_VALIDATION_RULES')) {
            $validate_rules = constant('SIGNUP_VALIDATION_RULES');
        }
        // 
        if ($this->request->getPost()) {
            if ($this->validate($validate_rules)) {
                // 
                if ($this->appuser->emailExist($this->request->getPost('email')) || $this->appuser->usernameExist($this->request->getPost('email'))) {
                    session()->setFlashdata('ui_mess', 'Indirizzo email già presente');
                    session()->setFlashdata('ui_mess_type', 'alert alert-danger');
                } else {
                    $new_user_data =  $this->appuser->register($this->request->getPost());
                    if ($new_user_data) {
                        $body_params = $new_user_data->data;
                        //
                        if (appIsFile($this->base_view_filesystem . 'email/attiva_account.html')) {
                            $htmlbody = file_get_contents(APPPATH . 'email/attiva_account.html');
                        } else {
                            $htmlbody = file_get_contents(APPPATH . '../LcUsers/Web/Views/email/attiva_account.html');
                        }
                        $htmlbody = str_replace('{{logo_path}}', env('custom.logo_path'), $htmlbody);
                        $htmlbody = str_replace('{{app_name}}', env('custom.app_name'), $htmlbody);
                        $htmlbody = str_replace('{{name}}', $body_params->name, $htmlbody);
                        $htmlbody = str_replace('{{surname}}', $body_params->surname, $htmlbody);
                        $htmlbody = str_replace('{{email}}', $body_params->email, $htmlbody);
                        $htmlbody = str_replace('{{activation_link}}', site_url(route_to('web_attiva_account', $body_params->activation_token)), $htmlbody);
                        $email_subject = 'Benvenuto in ' . env('custom.app_name') . ' - Verifica il tuo account';
                        if ($this->inviaEmail($body_params->email, $email_subject, $htmlbody)) {
                            session()->setFlashdata('ui_mess', 'Registrazione avvenuta con successo.');
                            session()->setFlashdata('ui_mess_description', 'Ti abbiamo inviato una mail per poter verificare i tuoi dati e attivare il tuo account.');
                            session()->setFlashdata('ui_mess_type', 'alert alert-success');
                            return TRUE;
                        } else {
                            session()->setFlashdata('ui_mess', $this->appLabelMethod("Si è verificato un errore durante l'invio della mail", $this->web_ui_date->app->labels));
                            session()->setFlashdata('ui_mess_type', 'alert alert-danger');
                            // $user_mess->content = $this->appLabelMethod("L'errore è stato segnalato e stiamo lavorando per risolvere il problema, riprova più tardi", $this->web_ui_date->app->labels);
                        }
                        // 
                    } else {
                        session()->setFlashdata('ui_mess', 'Si è verificato un errore durante la registrazione');
                        session()->setFlashdata('ui_mess_type', 'alert alert-danger');
                    }
                }
                // 
            } else {
                session()->setFlashdata('ui_mess', $this->validator->getErrors());
                session()->setFlashdata('ui_mess_type', 'alert alert-danger');
            }
        }
    }

    //--------------------------------------------------------------------
    public function attivaAccount(string $tokenString)
    {
        $activationTokenData = $this->appuser->getActivationTokenData($tokenString);

        if ($activationTokenData && $activationTokenData->data) {
            $this->appuser->activateAccount($activationTokenData->data);
            session()->setFlashdata('ui_mess', 'Account attivato con successo');
            session()->setFlashdata('ui_mess_type', 'alert alert-success');
            return redirect()->route('web_login');
        } else {
            session()->setFlashdata('ui_mess', 'Token non valido');
            session()->setFlashdata('ui_mess_type', 'alert alert-danger');
            return redirect()->route('web_login');
        }
    }

    //--------------------------------------------------------------------
    public function personalDashboard()
    {

        $user_data_model = new AppUsersDatasModel();
        $user_data = $user_data_model->find($this->appuser->getUserId());
        if (!$user_data) {
            return redirect()->route('web_login');
        }
        $this->web_ui_date->__set('user_data', $user_data);
        // 
        $curr_entity = new stdClass();
        $curr_entity->titolo = 'La tua dashboard personale';
        $curr_entity->guid = 'dashboard';
        $curr_entity->testo = '';
        $curr_entity->seo_title = 'La tua dashboard personale';
        $curr_entity->seo_description = '';

        $refShopActionContoller = 'LcShop\Web\Controllers\ShopAction';
        if (class_exists($refShopActionContoller)) {
            $shop_action = new $refShopActionContoller();
            $latest_user_orders = $shop_action->getUserOrders($this->appuser->getUserId());
            $curr_entity->latest_user_orders = $latest_user_orders;
        }
        //
        $this->web_ui_date->fill((array)$curr_entity);
        // 
        $this->web_ui_date->__set('master_view', 'user-dashboard');
        return view(customOrDefaultViewFragment('users/dashboard', 'LcUsers'), $this->web_ui_date->toArray());
    }

    //--------------------------------------------------------------------
    public function userChangePassword()
    {
        $user_data_model = new AppUsersDatasModel();
        $user_data = $user_data_model->find($this->appuser->getUserId());
        if (!$user_data) {
            return redirect()->route('web_login');
        }

        // 
        $validate_rules = [
            'old_password' => ['label' => 'Vecchia password', 'rules' => 'required'],
            'new_password' => ['label' => 'Password', 'rules' => 'required|min_length[8]'],
            'confirm_new_password' => ['label' => 'Conferma Password', 'rules' => 'required|matches[new_password]'],
        ];
        // 
        if (defined('PROFILE_CHANGE_PASSWORD_VALIDATION_RULES')) {
            $validate_rules = constant('PROFILE_CHANGE_PASSWORD_VALIDATION_RULES');
        }
        // 
        if ($this->request->getPost('action') == 'save_new_password') {
            if ($this->validate($validate_rules)) {
                if ($old_user_data = $this->appuser->checkPassword($this->request->getPost('old_password'), $this->appuser->getUserAuthId())) {
                    if ($old_user_data->data->id != null) {
                        if ($this->appuser->changeUserPassword($old_user_data->data->id, $this->request->getPost())) {
                            // $this->appuser->logout();
                            // return redirect()->route('web_login');
                            session()->setFlashdata('ui_mess', 'Password modificata con successo');
                            session()->setFlashdata('ui_mess_type', 'alert alert-success');
                        }
                    }
                } else {
                    session()->setFlashdata('ui_mess', 'Password errata');
                    session()->setFlashdata('ui_mess_type', 'alert alert-danger');
                }
            } else {
                session()->setFlashdata('ui_mess', $this->validator->getErrors());
                session()->setFlashdata('ui_mess_type', 'alert alert-danger');
            }
        }
        // 
        $this->web_ui_date->__set('user_data', $user_data);
        // 
        $curr_entity = new stdClass();
        $curr_entity->titolo = 'Crea la tua nuova password';
        $curr_entity->guid = 'password';
        $curr_entity->testo = '';
        $curr_entity->seo_title = 'Crea la tua nuova password';
        $curr_entity->seo_description = '';
        $this->web_ui_date->fill((array)$curr_entity);
        $this->web_ui_date->__set('user_data', $user_data);
        //
        $this->web_ui_date->__set('master_view', 'user-profile-change-password');
        return view(customOrDefaultViewFragment('users/profile-change-password', 'LcUsers'), $this->web_ui_date->toArray());
        // //
        // if (appIsFile($this->base_view_filesystem . 'users/profile-change-password.php')) {
        //     $this->web_ui_date->__set('master_view', 'profile-change-password');
        //     return view($this->base_view_namespace . 'users/profile-change-password', $this->web_ui_date->toArray());
        // } else {
        //     $this->web_ui_date->__set('master_view', 'user-profile-change-password');
        //     $this->web_ui_date->__set('base_view_folder', $this->base_view_namespace);
        //     return view($this->LcUsers_views_namespace . 'profile-change-password', $this->web_ui_date->toArray());
        // }
    }

    //--------------------------------------------------------------------
    public function shopOrders()
    {
        $user_data_model = new AppUsersDatasModel();
        $user_data = $user_data_model->find($this->appuser->getUserId());
        if (!$user_data) {
            return redirect()->route('web_login');
        }
        // 
        $curr_entity = new stdClass();
        $curr_entity->titolo = 'I tuoi Ordini';
        $curr_entity->guid = 'orders';
        $curr_entity->testo = '';
        $curr_entity->seo_title = 'I tuoi Ordini';
        $curr_entity->seo_description = '';

        $refShopActionContoller = 'LcShop\Web\Controllers\ShopAction';
        if (class_exists($refShopActionContoller)) {
            $shop_action = new $refShopActionContoller();
            $user_orders_list = $shop_action->getUserOrders($this->appuser->getUserId());
            $curr_entity->user_orders_list = $user_orders_list;
        }



        $this->web_ui_date->fill((array)$curr_entity);
        $this->web_ui_date->__set('user_data', $user_data);
        //
        $this->web_ui_date->__set('master_view', 'user-orders');
        return view(customOrDefaultViewFragment('users/orders', 'LcUsers'), $this->web_ui_date->toArray());
    }
    //--------------------------------------------------------------------
    public function shopOrderDett($id_oder)
    {
        $user_data_model = new AppUsersDatasModel();
        $user_data = $user_data_model->find($this->appuser->getUserId());
        if (!$user_data) {
            return redirect()->route('web_login');
        }
        // 
        $curr_entity = new stdClass();
        $curr_entity->titolo = 'Il tuo Ordine';
        $curr_entity->guid = 'order-dett';
        $curr_entity->testo = '';
        $curr_entity->seo_title = 'Il tuo Ordine';
        $curr_entity->seo_description = '';

        $refShopActionContoller = 'LcShop\Web\Controllers\ShopAction';
        if (class_exists($refShopActionContoller)) {
            $shop_action = new $refShopActionContoller();
            $order_data = $shop_action->getUserOrderDett($this->appuser->getUserId(), $id_oder);
            $curr_entity->order_data = $order_data;
        }



        $this->web_ui_date->fill((array)$curr_entity);
        $this->web_ui_date->__set('user_data', $user_data);
        //
        $this->web_ui_date->__set('master_view', 'user-orders');
        return view(customOrDefaultViewFragment('users/orders-dett', 'LcUsers'), $this->web_ui_date->toArray());
    }

    //--------------------------------------------------------------------
    public function userProfile()
    {
        $user_data_model = new AppUsersDatasModel();
        $user_data = $user_data_model->find($this->appuser->getUserId());
        if (!$user_data) {
            return redirect()->route('web_login');
        }
        // 
        $validate_rules = [
            'name' => ['label' => 'Nome', 'rules' => 'required'],
            'surname' => ['label' => 'Cognome', 'rules' => 'required'],
        ];
        // 
        if (defined('PROFILE_EDIT_VALIDATION_RULES')) {
            $validate_rules = constant('PROFILE_EDIT_VALIDATION_RULES');
        }
        // 
        if ($this->request->getPost('action') == 'save_account_data') {
            if ($this->validate($validate_rules)) {
                $this->appuser->updateUserData($this->request->getPost());
            } else {
                session()->setFlashdata('ui_mess', $this->validator->getErrors());
                session()->setFlashdata('ui_mess_type', 'alert alert-danger');
            }
        }
        // 
        $curr_entity = new stdClass();
        $curr_entity->titolo = 'I tuoi dati personali';
        $curr_entity->guid = 'profile';
        $curr_entity->testo = '';
        $curr_entity->seo_title = 'I tuoi dati personali';
        $curr_entity->seo_description = '';
        $this->web_ui_date->fill((array)$curr_entity);
        $this->web_ui_date->__set('user_data', $user_data);
        //
        $this->web_ui_date->__set('master_view', 'user-profile-edit');
        return view(customOrDefaultViewFragment('users/profile-edit', 'LcUsers'), $this->web_ui_date->toArray());
    }
}
