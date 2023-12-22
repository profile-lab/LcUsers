<?php

namespace LcUsers\Data\Entities;

use CodeIgniter\Entity\Entity;

class AppUsersData extends Entity
{
	protected $attributes = [
		'id' => null, 
		'nickname' => null, 
		'status' => 0, 
		'status_message' => 'non_attivo', 
		'id_app' => null, 
		'role' => 'USER', 
		'permissions_level' => 1, 
		'email' => null, 
		'name' => null, 
		'surname' => null, 
		'cf' => null, 
		'piva' => null, 
		'address' => null, 
		'city' => null, 
		'cap' => null, 
		'tel_num' => null, 
		't_e_c' => 0, 
		'privacy' => 0, 
		'auth_1' => null, 
		'auth_2' => null, 
		'auth_3' => null, 
		'auth_4' => null, 
		'auth_5' => null, 
		'last_active' => null, 

		'country' => 'IT',
		'district' => null,
		'street_number' => null,




	];
}
