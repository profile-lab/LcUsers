<?php

namespace LcUsers\Cms\Controllers;

use Lc5\Cms\Controllers\MasterLc;
// 
use LcUsers\Data\Entities\AppUsersAuth;
use LcUsers\Data\Entities\AppUsersData;
use LcUsers\Data\Models\AppUsersAuthsModel;
use LcUsers\Data\Models\AppUsersDatasModel;

class SiteUsers extends MasterLc
{
	private $appuser_data_model;
	private $appuser_auth_model;
	//--------------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		// 
		$this->appuser_auth_model = new AppUsersAuthsModel();
		$this->appuser_data_model = new AppUsersDatasModel();

		$this->module_name = 'Utenti';
		$this->route_prefix = 'lc_site_users';
		// 
		$this->lc_ui_date->__set('request', $this->req);
		$this->lc_ui_date->__set('route_prefix', $this->route_prefix);
		$this->lc_ui_date->__set('module_name', $this->module_name);
		// 
		$this->lc_ui_date->__set('currernt_module', 'lcusers');
		// 

	}

	//--------------------------------------------------------------------
	public function index()
	{
		// 
		$list = $this->appuser_data_model->where('status', 1)->orderBy('id', 'DESC')->findAll();
		$this->lc_ui_date->list = $list;
		// 
		return view('LcUsers\Cms\Views/site-users/index', $this->lc_ui_date->toArray());
	}

	//--------------------------------------------------------------------
	public function newpost($parent_id = 0)
	{
		exit('newpost');
	}

	//--------------------------------------------------------------------
	public function edit($id)
	{

		if (!$curr_entity = $this->appuser_data_model->find($id)) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
		// 
		if ($this->req->getPost()) {


			$validate_rules = [
				'nome' => ['label' => 'Nome', 'rules' => 'required'],
			];
			$is_falied = TRUE;
			$curr_entity->fill($this->req->getPost());
			if ($this->validate($validate_rules)) {
				

				$this->appuser_data_model->save($curr_entity);



				// 
				return redirect()->route($this->route_prefix . '_edit', [$curr_entity->id]);
			} else {
				$errMess = $this->lc_parseValidator($this->validator->getErrors());
			}
			if ($is_falied) {
				$this->lc_ui_date->ui_mess =  ((isset($errMess)) ? $errMess : 'Utente non trovato! Controlla i dati inseriti!');
				$this->lc_ui_date->ui_mess_type = 'alert alert-danger';
			}
		}

		// 
		$this->lc_ui_date->entity = $curr_entity;
		return view('LcUsers\Cms\Views/site-users/scheda', $this->lc_ui_date->toArray());
	}

	//--------------------------------------------------------------------
	public function delete($id)
	{

		if (!$curr_entity = $this->appuser_data_model->find($id)) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
		$this->appuser_data_model->delete($curr_entity->id);
		$this->lc_setErrorMess('Contenuto eliminato con successo', 'alert-warning');

		return redirect()->route($this->route_prefix);
	}
}
