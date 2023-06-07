<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErStrReturPenjualan extends Model
{
	protected $connection = 'mysql_erp';
	public $incrementing = false;
    protected $table = 'er_str_retur_penjualan';
    protected $fillable = ['id_retur', 'id_penjualan', 'keterangan', 'respon_note', 'code', 'status', 'created', 'created_by', 'date_submission', 'date_approved']; 
}
