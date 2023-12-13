<?php

namespace LcUsers\Data\Models;

use Lc5\Data\Models\MasterModel;

class AppUsersDatasModel extends MasterModel
{

	public $shop_settings = null;

	protected $table                = 'app_users_data';
	protected $primaryKey           = 'id';
	protected $useSoftDeletes 		= true;
	protected $createdField  		= 'created_at';
	protected $updatedField  		= 'updated_at';
	protected $deletedField  		= 'deleted_at';

	protected $returnType           = 'LcUsers\Data\Entities\AppUsersData';
	protected $allowedFields        = [
		'id', 
		'nickname', 
		'status', 
		'status_message', 
		'id_app', 
		'role', 
		'permissions_level', 
		'email', 
		'name', 
		'surname', 
		'cf', 
		'piva', 
		'address', 
		'city', 
		'cap', 
		'tel_num', 
		't_e_c', 
		'privacy', 
		'auth_1', 
		'auth_2', 
		'auth_3', 
		'auth_4', 
		'auth_5', 
		'last_active', 

	];

	protected $beforeInsert         = ['beforeInsert'];
	protected $afterInsert          = [];
	protected $beforeUpdate         = ['beforeUpdate'];
	protected $afterUpdate          = [];
	protected $beforeFind           = ['beforeFind'];
	protected $afterFind            = ['afterFind'];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	protected function beforeFind(array $data)
	{
		$this->checkAppAndLang();
		//
		// if($this->is_for_frontend == true){
		// 	$this->where('status !=', 0);
		// 	$this->where('public', 1);
		// }
		// 
	}

	//------------------------------------------------------------
	protected function afterFind(array $data)
	{
		// $data = $this->beforeSave($data);
		if ($data['singleton'] == true) {
			$data['data'] = $this->extendData($data['data'], true);
		} else {
			foreach ($data['data'] as $item) {
				$item = $this->extendData($item);
			}
		}
		return $data;
	}

	//------------------------------------------------------------
	private function extendData($item, $is_singleton = false)
	{
		if ($item) {
		}
		return $item;
	}

	//------------------------------------------------------------
	protected function beforeUpdate(array $data)
	{
		$data = $this->beforeSave($data);
		return $data;
	}

	//------------------------------------------------------------
	protected function beforeInsert(array $data)
	{
		if (in_array('id_app', $this->allowedFields)) {
			if(defined('__web_app_id__')){
				$curr_app = constant('__web_app_id__');
				if($curr_app){
					$data['data']['id_app'] = $curr_app;
				}
			}
		}
		$data = $this->beforeSave($data);
		return $data;
	}

	//------------------------------------------------------------
	private function beforeSave(array $data)
	{
		
		return $data;
	}



	
}
