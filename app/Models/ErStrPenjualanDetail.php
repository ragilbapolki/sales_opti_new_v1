<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErStrPenjualanDetail extends Model
{
	protected $connection = 'mysql_erp';
	public $incrementing = false;
    protected $table = 'er_str_penjualan_detail';
    protected $fillable = ['id_penjualan_detail', 'id_penjualan', 'id_product', 'qty', 'subtotal', 'disc_member', 'tipe_disc', 'diskon', 'id_promo', 'point', 'product_price']; 
}
