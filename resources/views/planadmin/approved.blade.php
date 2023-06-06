@extends('layouts.master')

@section('title','CDI | Plan Disetujui')
@section('minititle','Plan Disetujui')

@section('css')
    @include('css.datatables.full')
    <style>
        .dataTables_filter, .dataTables_info { display: none; }
    </style>
@stop

@section('content')
    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
      <h1>
        Approved Plan
        <small>CDI</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('page_plan') }}"><i class="fa fa-calendar"></i> Rencana Kunjungan</a></li>
        <li class="active">Approved Plan</li>
      </ol>
    </section> --}}
    <!-- Main content -->
    <section class="content">


      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"></h4>

      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
              <div class="box-body">
                <div class="row">
                  <div class="col-sm-12">
                    <!-- <table id="dataplan" class="display compact" cellspacing="0" width="100%"> -->
                    <table id="dataplan" class="display nowrap cell-border compact" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <!-- <th>Action</th> -->
                          <th>Status</th>
                          <th>Tgl Plan</th>
                          <th>Sales</th>
                          <th>Customer</th>
                          <th>Alamat</th>
                          <th>Tujuan</th>
                          <th>Tgl Visit</th>
                          <th>Hasil</th>
                          <th>DurasiVisit</th>
                          <th>Lokasi</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <!-- <th>Action</th> -->
                          <th></th>
                          <th>Tgl Plan</th>
                          <th>Sales</th>
                          <th>Customer</th>
                          <th></th>
                          <th></th>
                          <th>Tgl Visit</th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
          <div class="row">
            <div class="col-xs-11">
              <a href="{{route('page_plan')}}" class="btn btn-default btn-circle btn-lg" ><i class="fa fa-angle-double-left"></i></a>
            </div>
          </div>

            </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
@endsection

@section('javascript')
    @include('js.datatables.full')
@stop

@section('page-script')
<script>
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: 'post',
      url: '{!! route('plan_approvedshow') !!}',
      cache:false,
      success: function(data) {
        // Setup - add a text input to each footer cell
        $('#dataplan tfoot th').each( function () {
            var title = $(this).text();
            if (title=='Tgl Plan') {
                $(this).html( '<input type="text" placeholder="Filter Tgl" style="color: #aa001e; width:100px;" />' );
            }else if(title=='Sales'){
                        $(this).html('<input type="text" placeholder="Filter Sales" style="color: #aa001e; width:99px;">');
            }else if(title=='Customer'){
                        $(this).html('<input type="text" placeholder="Filter Cust" style="color: #aa001e; width:121px;">');
            }else if(title=='Tgl Visit'){
                        $(this).html('<input type="text" placeholder="Filter Tgl" style="color: #aa001e; width:121px;">');
            }
        } );
        
        var table = $('#dataplan').DataTable({
          "language": {
            "emptyTable": "Data tidak ditemukan"
          },
          dom: 'Bfrtip',
          buttons: ['pageLength',
            {
            extend: 'excelHtml5',
            exportOptions: { orthogonal: 'export' },
            title: 'Approved Plan'
            },
            //'print'
          ],
          scrollX: true,
          // searching: true,
          // paging: false,
          bInfo : false,
          bLengthChange: false,
          select:true,
          order: [[ 2, 'asc' ]],
          data : data.data,
          columnDefs: [
            { "width": "3%", "targets": 0 }
          ],
          columns: [
              // { data: 'status', name: 'status',render: function ( data, type, row ) {
              //     // return data == 1 ? '<button class="btn bg-green btn-xs delsales" ><i class="fa fa-play"></i>  </button>' : '' 
              //     if (data==1) {
              //       return '<button class="btn bg-green btn-xs delsales" ><i class="fa fa-play"></i>  </button>';
              //     }else if(data==2){
              //       return '<button class="btn bg-red btn-xs delsales" ><i class="fa fa-stop"></i>  </button>';
              //     }else{
              //       return '';
              //     }
              //   } 
              // },
              { data: 'status', name: 'status',render: function ( data, type, row ) {
                  // return data == 1 ? '<button class="btn bg-green btn-xs delsales" ><i class="fa fa-play"></i>  </button>' : '' 
                  if (data==0) {
                    return 'Pending';
                  }else if(data==1){
                    return 'Disetujui';
                  }else if(data==2){
                    return 'Sedang ChekIn';
                  }else{
                    return 'Selesai';
                  }
                } 
              },
              // { data: 'tgl',name:'tgl'},
              { data: 'tgl', width: '99px' },
              { data: 'user.name'},
              { data: 'customer.name', width: '121px' },
              { data: 'customer.alamat'},
              { data: 'keterangan',name:'keterangan'},
              { data: 'cekout', name: 'tglcekin',render: function ( data, type, row ) {return data == null ? '' : data.tgl } },
              { data: 'cekout', name: 'cekout',render: function ( data, type, row ) {return data == null ? '' : data.keterangan } },
              { data: 'cekout',render: function ( data, type, row ) {
                  // return data == 1 ? '<button class="btn bg-green btn-xs delsales" ><i class="fa fa-play"></i>  </button>' : '' 
                  if (data == null) {
                    var durasi = '';
                  } else{
                    var datang = data.created_at;
                    var pulang = data.updated_at;
                    if(pulang == null){
                     return '';
                    }else{
                      var date1 = new Date(datang);
                      var date2 = new Date(pulang);
                      var diff = date2.getTime() - date1.getTime();
                      var msec = diff;
                      var hh = Math.floor(msec / 1000 / 60 / 60);
                      msec -= hh * 1000 * 60 * 60;
                      var mm = Math.floor(msec / 1000 / 60);
                      msec -= mm * 1000 * 60;
                      var ss = Math.floor(msec / 1000);
                      msec -= ss * 1000;
                    }
                  }
                  return data == null ? '' : hh + ":" + mm + ":" + ss
                } 
              },
              { data: "cekout", name:"cekout",render: function ( data, type, row ) {return data == null ? '' : '<a href="lokasi/'+row.id+'" target="_blank">Lokasi</a>' }}
          ]
        });

        //Filter event handler
        table.columns().every( function () {
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
      }
    });
  });
</script>
@stop