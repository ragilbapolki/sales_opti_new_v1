<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AauthUsers extends Model
{
	protected $connection = 'mysql_erp';
	public $incrementing = false;
    protected $table = 'aauth_users';
    protected $fillable = ['id', 'email', 'oauth_uid', 'oauth_provider', 'pass', 'username', 'full_name', 'avatar', 'banned', 'last_login', 'last_activity', 'date_created', 'forgot_exp', 'remember_time', 'remember_exp', 'verification_code', 'top_secret', 'id_organisasi', 'ip_address', 'nip']; 
}
