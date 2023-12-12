<?php

namespace LcUsers\Data\Entities;

use CodeIgniter\Entity\Entity;

class AppUsersAuth extends Entity
{
	protected $attributes = [
		'id' => null, 
		'user_id' => null, 
		'type' => null, 
		'active' => null, 
		'id_app' => null, 
		'username' => null, 
		'secret' => null, 
		'activation_token' => null, 
		'token' => null, 
		'expires' => null, 
		'extra' => null, 
		'force_reset' => null, 
		'last_used_at' => null, 



	];
}
