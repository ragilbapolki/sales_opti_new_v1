<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErMdStrukturOrganisasi extends Model
{
	protected $connection = 'mysql_erp';
	public $incrementing = false;
    protected $table = 'er_md_struktur_organisasi';
    protected $fillable = ['id_organisasi', 'nama_perusahaan', 'id_induk_organisasi', 'jenis_usaha', 'area_operasional', 'kode_cabang', 'nama_cabang', 'kode_sub_akun_jurnal', 'pimpinan', 'alamat', 'negara', 'provinsi', 'kota', 'kode_pos', 'telephone', 'fax', 'nomor_PAK_CPAK_Nomor_izin', 'SIUP', 'pendaftar_penanam_modal', 'NPWP', 'NIB', 'angka_pengenal_import_produsen_APIP', 'fasilitas_bea_masuk_import', 'fasilitas_fiskal_lainnya', 'rencana_penggunaan_tenaga_asing', 'izin_lokasi', 'SK_hak_asasi_tanah', 'izin_mendirikan_bangunan', 'izin_UU_gangguan_HO_Amdal_SPPL', 'izin_teknis_lainnya', 'alamat_workshop', 'status_aktif_non_aktif', 'last_update', 'jam_start', 'jam_end', 'bank', 'akun_bank', 'atas_nama', 'price_category', 'pic', 'jurnal_posting_date']; 
}
