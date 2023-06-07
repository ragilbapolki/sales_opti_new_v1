<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErMdMember extends Model
{
	protected $connection = 'mysql_erp';
	public $incrementing = false;
    protected $table = 'er_md_member';
    protected $fillable = ['id_member', 'id_user', 'id_jenis_member', 'id_jns_faktur', 'no_cust', 'no_ccc', 'nama_member', 'tempat_lahir', 'tgl_lahir', 'alamat', 'alamat_detail', 'nik', 'no_npwp', 'jns_kelamin', 'id_list_title', 'no_kontak', 'email', 'status', 'tgl_register', 'created', 'vabca', 'vamandiri']; 
}
