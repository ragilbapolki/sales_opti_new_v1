<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErMdMitra extends Model
{
	protected $connection = 'mysql_erp';
	public $incrementing = false;
    protected $table = 'er_md_mitra';
    protected $fillable = ['id_product', 'id_organisasi', 'code', 'nie', 'deskripsi', 'satuan_beli', 'pengali', 'satuan_jual', 'nama_supplier', 'kategori_product', 'harga_per_satuan_beli', 'harga_per_satuan_jual', 'harga_per_satuan_jual_non_jawa', 'stock', 'rec_price', 'rec_order', 'reorder_level', 'keterangan', 'id_rak', 'barcode_sku', 'barcode_nie']; 
}
