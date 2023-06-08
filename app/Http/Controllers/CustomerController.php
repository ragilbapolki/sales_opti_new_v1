<?php

namespace App\Http\Controllers;

use App\Models\ErStrPenjualan;
use Illuminate\Http\Request;
use App\{Customer, User, Plan, Cekout}; //model tabel Customers
use App\WebsalesTmpTransaksi; //model tabel logs
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; //untuk session auth
use Yajra\Datatables\Datatables; // untuk datatables

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function page_cust_aktivitas()
    {
    	 return view('custaktivitas.index');
    }

    public function page_cust_ccc()
    {
       return view('custccc.index');
    }
    public function data_cust_ccc()
    {
        // $data_ccc = Customer::select('id','ccc','ccc_reg','ccc_aktif','ccc_level','ccc_balance','ccc_poin','last_transaksi','name','tgl_lahir' ,'titel','alamat','kota','telp','hp','email')->where('ccc', '<>', '');

      // $data_ccc = DB::connection('mysql_external')->table('customers')
      // ->select('id','ccc','ccc_reg','ccc_aktif','ccc_level','ccc_balance','ccc_poin','last_transaksi','name','tgl_lahir' ,'titel','alamat','kota','telp','hp','email')
      // ->where('ccc','<>','')
      // ->where('ccc_reg','<>','c000');
      $data_ccc = DB::connection('mysql_external_two')->table('online_cust')
      ->select('cust_autonumber','cust_reward_id','cabang_reg_ccc','ccc_aktif','cust_reward_level','tgldaftar','ccc_poin_balance','ccc_poin','last_transaction','nama','birthdate','titel','alamat','kota','telp','hp','kodepos','email','voucher')
      ->where([['cust_reward_id', '<>', ''],['cust_reward_level', '<>', ''],['cabang_reg_ccc', '<>', 'c000']]);        

      // var_dump($data_ccc);
      // die();
      
      // dd($data_ccc);

        return Datatables::of($data_ccc)->make(true);
    }

    public function search_cust_aktivitas(Request $request)
    {
      $this->validate($request,[
        'customer' => 'required',
      ]);
    	$id =  $request->customer;

      $customer = Customer::select('id','name','alamat',DB::raw('DATE_FORMAT(tgl_lahir,"%d %M") as tgl_lahir'))->find($id);
      $cekout = Cekout::select('user_id','customer_id','created_at','keterangan',DB::raw('DATE_FORMAT(tgl,"%d-%m-%Y") as tgl'))
      ->where('customer_id',$id)
      ->with('user:id,name')
      ->orderBy('id', 'desc')->take(5)->get();
      
          if ($cekout==NULL) {
            $cekout=[];
          }
          $data = [
            'customer' => $customer,
            'plan' => $cekout,
          ];

          $response = [
              'msg' => 'Success',
              'data' => $data
          ];
    	return response()->json($response,200);
    }

    public function tabel_show_aktivitas(Request $request)
    {
      $user_id = Auth::user()->id;
      $customer_id = $request->idcust;
      $skac = new KoneksiController;
      $koneksi= $skac -> KoneksiDC();
      $customerArray = Customer::find($customer_id);

      // if (empty ($customerArray->ccc)) { //bukan member ccc
          $DelTmpTransk=$koneksi->query("DELETE FROM webapp.sales_penjualan WHERE user_id='$user_id'");
          $DelTmpTranskdetil=$koneksi->query("DELETE FROM webapp.sales_penjualan_detil WHERE user_id='$user_id'");
          $kueri= "SELECT kode,nama,alamat FROM cobradental_master_pos.cabang_new WHERE kode not like '%c000%' AND kode like '%c0%' ORDER BY kode ";
          $result=$koneksi -> query($kueri);
          while ($row=$result->fetch_object()) {
            $kode=$row->kode;
            $kueristok="INSERT INTO webapp.sales_penjualan (nota,tgl,total,regulerid,user_id)
                        SELECT a.nota,a.tgl,a.totalpenjualan,a.customer,'$user_id' FROM ".$kode.".penjualan a WHERE a.customer='$customer_id' AND a.nota NOT IN (SELECT nota FROM ".$kode.".batal)" ;
            $resultstok=$koneksi->query($kueristok);
          }$result->close();

          $kueri= "SELECT a.*,DATE_FORMAT(tgl, '%d-%m-%Y') AS tanggal FROM webapp.sales_penjualan a WHERE a.regulerid='$customer_id' AND a.user_id='$user_id' ORDER BY tgl DESC LIMIT 100";
          $result=$koneksi -> query($kueri);
          if ($result->num_rows > 0) {
             while ($row=$result->fetch_object()) {
              $nota = $row->nota;
              $tgl = $row->tgl;
              $pisah = explode(".",$row->nota);
              $cabang = $pisah[0];
              $kueriTmpTransk = "INSERT INTO webapp.sales_penjualan_detil(nota,kobar,diskon,harga,qty,retur,hbeli,ppn,regulerid,user_id)
                                SELECT a.nota,a.kobar,a.diskon,a.harga,a.qty,a.retur,a.hbeli,a.ppn,'$customer_id','$user_id'
                                FROM ".$cabang.".penjualan_detil a JOIN cobradental_master_pos.databarang b ON a.kobar=b.kode_gudang WHERE a.nota='$nota'";
              $result2=$koneksi -> query($kueriTmpTransk);
              // $detail = WebsalesTmpTransaksi::where('nota', $nota)
              // ->where('user_id',$user_id)
              // ->with('barang')->get();
              $detail = DB::connection('mysql_external')->table('sales_penjualan_detil')->join('items', 'sales_penjualan_detil.kobar', '=', 'items.id')
              ->where('sales_penjualan_detil.nota', $nota)
              ->where('user_id',$user_id)
              ->get(['items.id','items.nama','sales_penjualan_detil.qty']);


              $plans[]=(object) array(
                 "tgl" => $row->tanggal,
                 // "cabang" => $cabang,
                 "nota" => $row->nota,
                 "total" => $row->total,
                 "detail" => $detail,
                 );
             }$result->close();
             return Datatables::of($plans)->make(true);
          } else {
              print    "{\"data\":[] }"; //output json andro
          }
      // } else{
      //   // $skac = new KoneksiController;
      //   // $koneksi= $skac -> KoneksiDC();
      //   $DelTmpTransk=$koneksi->query("DELETE FROM webapp.sales_penjualan_detil WHERE user_id='$user_id'");
      //   $kueri= "SELECT *,DATE_FORMAT(tgl, '%d-%m-%Y') AS tanggal FROM cobradental_master_pos.api_transaksi a WHERE a.user_id='$customer_id' AND batal='0' ORDER BY tgl DESC LIMIT 5";
      //   $result=$koneksi -> query($kueri);
      //   if ($result->num_rows > 0) {
      //      while ($row=$result->fetch_object()) {
      //       $nota = $row->nota;
      //       $tgl = $row->tgl;
      //       $pisah = explode(".",$row->nota);
      //       $cabang = $pisah[0];
      //       $kueriTmpTransk = "INSERT INTO webapp.sales_penjualan_detil(nota,kobar,diskon,harga,qty,retur,hbeli,ppn,regulerid,user_id)
      //                         SELECT a.nota,a.kobar,a.diskon,a.harga,a.qty,a.retur,a.hbeli,a.ppn,'$customer_id','$user_id'
      //                         FROM ".$cabang.".penjualan_detil a JOIN cobradental_master_pos.databarang b ON a.kobar=b.kode_gudang WHERE a.nota='$nota'";
      //       $result2=$koneksi -> query($kueriTmpTransk);
      //       // $detail = WebsalesTmpTransaksi::where('nota', $nota)
      //       // ->where('user_id',$user_id)
      //       // ->with('barang')->get();
      //       $detail = DB::connection('mysql_external')->table('sales_penjualan_detil')->join('items', 'sales_penjualan_detil.kobar', '=', 'items.id')
      //       ->where('sales_penjualan_detil.nota', $nota)
      //       ->where('user_id',$user_id)
      //       ->get(['items.id','items.nama','sales_penjualan_detil.qty']);


      //       $plans[]=(object) array(
      //          "tgl" => $row->tanggal,
      //          // "cabang" => $cabang,
      //          "nota" => $row->nota,
      //          "total" => $row->total,
      //          "detail" => $detail,
      //          );
      //      }$result->close();
      //      return Datatables::of($plans)->make(true);
      //   } else {
      //       print    "{\"data\":[] }"; //output json andro
      //   }
      // }
    }

    public function page_cust_rank()
    {
      $now = date("Y");
      $sebelumnya = date("Y", strtotime("$now -1 year"));
      $berikutnya = date("Y", strtotime("$now +1 year"));
      $tahun[]=array(
          "now" => $now,
          "pre" => $sebelumnya,
          "next" => $berikutnya,
      );
      // dd($tahun);
      return view('custrank.index',['tahun' => $tahun]);
    }

    public function page_cust_rank2($id)
    {
      $skrang = $id;
      $date = $id.'-01-01';
      $sebelumnya = date('Y', strtotime("$date -1 year"));
      $berikutnya = date("Y", strtotime("$date +1 year"));
      $tahun[]=array(
          "now" => $skrang,
          "pre" => $sebelumnya,
          "next" => $berikutnya,
      );
      return view('custrank.index',['tahun' => $tahun]);
    }

    public function tabel_show_custrank(Request $request)
    {
      $cabang = Auth::user()->kode_cabang;
      $tahun = $request->tahun;
      $skac = new KoneksiController;
      $koneksi= $skac -> KoneksiERPV1();
      $kueri= "SELECT
      p.no_nota, mtr.nama_perusahaan, d.subtotal, d.qty, d.diskon, p.tgl_tansaksi, pd.deskripsi, rtr.id_retur, p.id_customer, aa.id_member,
      aa.nama_member
    FROM
      er_str_penjualan p
      JOIN er_str_penjualan_detail d ON d.id_penjualan = p.id_penjualan
      JOIN er_md_product pd ON pd.id_product = d.id_product
      JOIN er_md_mitra mtr ON pd.nama_supplier = mtr.id_mitra
      JOIN aauth_users users ON users.id = p.created_by
      LEFT JOIN er_str_retur_penjualan rtr ON rtr.id_penjualan = d.id_penjualan 
      join er_md_member aa on p.id_customer = aa.id_member
      AND (
        rtr.date_approved BETWEEN '".$tahun."-01-01 00:00:00' 
        AND (
        SELECT
        LAST_DAY( '".$tahun."-01-01 23:59:00' ))) 
    WHERE p.tgl_tansaksi BETWEEN '".$tahun."-01-01 23:59:00' 
      AND  (
        SELECT
        LAST_DAY( '".$tahun."-01-01 23:59:00' ))
    GROUP BY
      d.id_penjualan_detail";
      $result=$koneksi -> query($kueri);
      $count = $result->num_rows;
      if ($count>0) {
        while ($row=$result->fetch_object()) {
          $response[]=(object) array(
            "no_nota"   	   => $row->no_nota,
            "nama_perusahaan"=> $row->nama_perusahaan,
            "nama_member"    => $row->nama_member,
            "qty"            => $row->qty,
            "diskon"         => $row->diskon,
            "tgl_tansaksi"   => $row->tgl_tansaksi,
            "deskripsi"      => $row->deskripsi,
            "subtotal"       => $row->subtotal,
            );
        }$result->close();
      } else {
        $response = [ ];
      }
      return Datatables::of($response)->make(true);
    }


}
