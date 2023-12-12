<?php

namespace LcUsers\Data\Entities;

use CodeIgniter\Entity\Entity;

class AppUsersAuth extends Entity
{
	protected $attributes = [
		'id' => null, 
		'user_id' => null, 
		'type' => 'email_password', 
		'single_sign_on_account' => '', 
		'single_sign_on_data' => '', 
		'active' => 0, 
		'id_app' => null, 
		'username' => null, 
		'secret' => null, 
		'activation_token' => null, 
		'token' => null, 
		'expires' => null, 
		'extra' => null, 
		'force_reset' => false, 
		'last_used_at' => null, 
		'activated_at' => null, 



	];
}
