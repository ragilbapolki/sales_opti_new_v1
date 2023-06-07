<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErStrPenjualan extends Model
{
	protected $connection = 'mysql_erp';
	public $incrementing = false;
    protected $table = 'er_str_penjualan';
    protected $fillable = ['id_penjualan', 'id_tim_sales', 'no_nota', 'tgl_tansaksi', 'id_customer', 'id_jns_penjualan', 'ongkir', 'faktur', 'totalbayar', 'status', 'jns_transaksi', 'jenis_bayar', 'jenis_kredit', 'no_mou', 'termin', 'jatuh_tempo', 'keterangan', 'qrcode', 'created', 'created_by', 'kembali']; 
}
