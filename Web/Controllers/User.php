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
        //
        if (appIsFile($this->base_view_filesystem . 'users/login.php')) {
            $this->web_ui_date->__set('master_view', 'user-login');
            return view($this->base_view_namespace . 'users/login', $this->web_ui_date->toArray());
        } else {
            $this->web_ui_date->__set('master_view', 'user-login-default');
            $this->web_ui_date->__set('base_view_folder', $this->base_view_namespace);
            return view($this->LcUsers_views_namespace . 'login', $this->web_ui_date->toArray());
        }
    }

    // //--------------------------------------------------------------------
    // protected function loginPostAction():bool
    // {
    //     // 
    //     $validate_rules = [
    //         'email' => ['label' => 'Email', 'rules' => 'required'],
    //         'password' => ['label' => 'Password', 'rules' => 'required'],
    //     ];
    //     // 
    //     if (defined('LOGIN_VALIDATION_RULES')) {
    //         $validate_rules = constant('LOGIN_VALIDATION_RULES');
    //     }
    //     // 
    //     if ($this->validate($validate_rules)) {
    //         $logged_user_data =  $this->appuser->login($this->request->getPost());
    //         if ($logged_user_data && $logged_user_data->code == 200 && $logged_user_data->data) {
    //             $this->appuser->setUserSession($logged_user_data->data);
    //             session()->setFlashdata('ui_mess', NULL);
    //             session()->setFlashdata('ui_mess_type', NULL);

    //             return TRUE;
    //             // return redirect()->route('web_dashboard');

    //             // if ($get_redirect = $this->request->getGet('returnTo', false)) {
    //             //     return redirect()->to(urldecode($get_redirect));
    //             // } else {
    //             // }

    //             // 
    //         } else {
    //             session()->setFlashdata('ui_mess', 'Nome utente o password errati');
    //             session()->setFlashdata('ui_mess_type', 'alert alert-danger');
    //         }
    //     } else {
    //         session()->setFlashdata('ui_mess', 'Nome utente o password errati');
    //         session()->setFlashdata('ui_mess_type', 'alert alert-danger');
    //     }
    //     return FALSE;
    // }

    //--------------------------------------------------------------------
    public function signUp()
    {
        $curr_entity = new stdClass();
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
                            return redirect()->route('web_login');
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
        // 
        $this->web_ui_date->fill((array)$curr_entity);
        //
        if (appIsFile($this->base_view_filesystem . 'users/signup.php')) {
            $this->web_ui_date->__set('master_view', 'user-signup');
            return view($this->base_view_namespace . 'users/signup', $this->web_ui_date->toArray());
        } else {
            $this->web_ui_date->__set('master_view', 'user-signup-default');
            $this->web_ui_date->__set('base_view_folder', $this->base_view_namespace);
            return view($this->LcUsers_views_namespace . 'signup', $this->web_ui_date->toArray());
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
        if (appIsFile($this->base_view_filesystem . 'users/dashboard.php')) {
            $this->web_ui_date->__set('master_view', 'user-dashboard');
            return view($this->base_view_namespace . 'users/dashboard', $this->web_ui_date->toArray());
        } else {
            $this->web_ui_date->__set('master_view', 'user-dashboard-default');
            $this->web_ui_date->__set('base_view_folder', $this->base_view_namespace);
            return view($this->LcUsers_views_namespace . 'dashboard', $this->web_ui_date->toArray());
        }
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
        $this->web_ui_date->__set('user_data', $user_data);

        //
        if (appIsFile($this->base_view_filesystem . 'users/profile-edit.php')) {
            $this->web_ui_date->__set('master_view', 'user-profile-edit');
            return view($this->base_view_namespace . 'users/profile-edit', $this->web_ui_date->toArray());
        } else {
            $this->web_ui_date->__set('master_view', 'user-profile-edit-default');
            $this->web_ui_date->__set('base_view_folder', $this->base_view_namespace);
            return view($this->LcUsers_views_namespace . 'profile-edit', $this->web_ui_date->toArray());
        }
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
