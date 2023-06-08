@extends('layouts.master')

@section('title', 'CDI | Cust Ranking')

@section('css')
    @include('css.datatables.simple')
    <style>
        #radioBtn .notActive {
            color: #3276b1;
            background-color: #fff;
        }

        #lightgreen {
            color: #3276b1;
            background-color: #92CD00;
        }

        .box.box-hijau {
            border-top-color: #92CD00;
        }
    </style>
@stop

@section('content')
    <section class="content">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"></h4>

                    <div class="row">
                        <div class="col-xs-12" id="hasil">
                            <div class="box box-hijau">
                                <div class="box-header">
                                    <i class="fa fa-signal"></i>
                                    <h3 class="box-title">Cust Rank Th.{{ $tahun[0]['now'] }}</h3>
                                    <input type="hidden" id="tahun" value="{{ $tahun[0]['now'] }}">
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        @if ($tahun[0]['pre'] == '2012')
                                            <a class="btn btn-default btn-sm" role="button"><i
                                                    class="fa fa-chevron-left"></i></a>
                                        @else
                                            <a class="btn btn-tumblr btn-sm"
                                                href="{{ route('page_cust_rank2', ['id' => $tahun[0]['pre']]) }}"
                                                role="button" title="{{ $tahun[0]['pre'] }}"><i
                                                    class="fa fa-chevron-left"></i></a>
                                        @endif

                                        @if ($tahun[0]['next'] == date('Y') + 1)
                                            <a class="btn btn-default btn-sm" role="button"><i
                                                    class="fa fa-chevron-right"></i></a>
                                        @else
                                            <a class="btn btn-tumblr btn-sm"
                                                href="{{ route('page_cust_rank2', ['id' => $tahun[0]['next']]) }}"
                                                role="button" title="{{ $tahun[0]['next'] }}"><i
                                                    class="fa fa-chevron-right"></i></a>
                                        @endif
                                    </div>
                                    <!-- /. tools -->
                                </div>
                                <div class="box-body table-bordered no-padding">
                                    <div class="col-xs-12">
                                        <table id="custrank" class="display nowrap compact" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No Nota</th>
                                                    <th>Cabang</th>
                                                    <th>Customer</th>
                                                    <th>Produk</th>
                                                    <th>Quantity</th>
                                                    <th>Diskon</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @include('panel.buttonhome')
    </section>
@endsection

@section('javascript')
    @include('js.datatables.simple')
@stop

@section('page-script')

    <script>
        $(document).ready(function() {
            $('.custranking').addClass('active');
        });
    </script>

    <script>
        $(document).ready(function() {
            var tahun = document.getElementById("tahun").value;
            var table = $('#custrank').DataTable({
                scrollY: "533px",
                scrollX: true,
                scrollCollapse: true,
                // paging: false,
                columnDefs: [{
                    width: '20%',
                    targets: 0
                }],
                fixedColumns: {
                    leftColumns: 1
                },
                // bInfo: false,
                select: true,
                order: [
                    [6, 'desc']
                ],
                "language": {
                    "emptyTable": "Data tidak ditemukan"
                },

                ajax: {
                    url: '{{ route('tabel_show_custrank') }}',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        tahun: tahun,
                    },
                    method: 'POST'
                },
                columns: [{
                        data: 'no_nota',
                        name: 'no_nota'
                    },
                    {
                        data: 'nama_perusahaan',
                        name: 'nama_perusahaan'
                    },
                    {
                        data: 'nama_member',
                        name: 'nama_member'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'diskon',
                        name: 'diskon',
                        "sClass": "text-right"
                    },
                    {
                        data: 'subtotal',
                        name: 'subtotal',
                        "render": $.fn.dataTable.render.number('.', ',', 0),
                        "sClass": "text-right"
                    }
                ]
            });
        });
    </script>
@stop
