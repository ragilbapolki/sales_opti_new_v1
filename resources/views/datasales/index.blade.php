@extends('layouts.master')

@section('title', 'CDI | List Sales')
@section('minititle', '')

@section('css')
    @include('css.datatables.full')
    <style>
        .none {
            display: none;
        }

        ,
        .showDIV {
            display: block;
        }
    </style>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List Sales</h4>
                        <div class="row">
                            <div class="col-md-12" style="color: crimson;font-size: 10px;">
                                <!-- <div class="alert alert-info alert-dismissible"> -->
                                    <h4><i class="icon fa fa-info"></i> Perhatian! </h4>
                                    * Jika Sales lupa Password, silahkan klik Edit untuk mengubah password.<br>
                                    * Apabila sales telah resign, maka user yg bersangkutan wajib dihapus.
                                <!-- </div> -->
                            </div>
                        </div>
                        <br>
                        {{-- <div class="row">
                            <div class="col-sm-5 col-sm-push-7">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <i class="fa fa-user-plus"></i>
                                        <h3 class="box-title">Tambahkan Akun Baru
                                            {{ strtoupper(Auth::user()->kode_cabang) }}</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <form class="form-horizontal" method="POST" action="{{ route('registersales') }}">
                                            {{ csrf_field() }}
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Nama*</label>

                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" placeholder="Nama" value="{{ old('name') }}"
                                                            onKeyUp="caps(this)" autocomplete="off" required autofocus>

                                                        @if ($errors->has('name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Username*</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="username"
                                                            placeholder="Min 5 karakter" value="{{ old('username') }}"
                                                            onKeyUp="fusername(this)" autocomplete="off" required>
                                                        @if ($errors->has('username'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('username') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Jabatan*</label>
                                                    <div class="col-sm-8">
                                                        <select name="jabatan" id="jabatan" class="form-control select2"
                                                            required>
                                                            <option value="" selected>Pilih Jabatan</option>
                                                            @foreach ($jabatans as $jabatan)
                                                                <option value="{{ $jabatan->id }}">{{ $jabatan->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Role*</label>
                                                    <div class="col-sm-8">
                                                        <select name="role" id="role" class="form-control select2"
                                                            required>
                                                            <option value="" selected>Pilih Role</option>
                                                            @foreach ($role as $r)
                                                                <option value="{{ $r->id }}">{{ $r->keterangan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">New Password*</label>

                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="password"
                                                            placeholder="Min 5 karakter" onKeyUp="caps(this)"
                                                            autocomplete="off" required>
                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password-confirm" class="col-sm-4 control-label">Retype
                                                        Password*</label>

                                                    <div class="col-sm-8">
                                                        <input id="password-confirm" type="password" class="form-control"
                                                            name="password_confirmation" onKeyUp="caps(this)" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">WA / Hp *</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="hp"
                                                            name="hp" maxlength="13"
                                                            oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                                            autocomplete="off" placeholder="harus diisi"
                                                            value="{{ old('hp') }}" required="" pattern=".{10,13}">

                                                        @if ($errors->has('hp'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('hp') }}</strong>
                                                            </span>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-outline-primary"
                                                    id="tmbSales">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-sm-12 ">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="datasales" class="display nowrap compact" cellspacing="0"
                                                    width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama</th>
                                                            <th>Username</th>
                                                            <th>Jabatan</th>
                                                            <th>No HP</th>
                                                            <th>action</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('datasales.partials.modal')
                        {{-- @include('panel.buttonhome') --}}
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
        $(document).ready(function() {
            $('.datasales').addClass('active');
<<<<<<< HEAD

=======
            $('#modal-editsales').modal({backdrop: 'static', keyboard: false})  
            $(".batal").click(function(){
                $('#modal-editsales').modal('hide');
            })
>>>>>>> 92bc7915d37b5684793e00835b50c46265d1774f
            $('.form-control').bind("cut copy paste", function(e) {
                e.preventDefault();
                alert("Maaf, Mohon isi data dengan diketik");
                $('#textbox_id').bind("contextmenu", function(e) {
                    e.preventDefault();
                });
            });

            $("#hpsstoremanager").click(function() {
                var idsales = $('#hapusid').text();
                $.ajax({
                    type: 'POST',
                    url: 'sales/' + idsales,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": idsales,
                        "_method": "put"
                    },
                    cache: false,
                    success: function() {
                        $('#modal-hpssales').modal('hide');
                        $('#datasales').DataTable().ajax.reload();
                    }
                });
            });

            caps = function(element) {
                element.value = element.value.toLowerCase();
            }
            fusername = function(element) {
                var val = element.value;
                var pattern = new RegExp('[ ]+', 'g');
                val = val.replace(pattern, '');
                element.value = val.toLowerCase();
            }
            var table = $('#datasales').DataTable({
                responsive: true,
                "scrollX": true,
                "language": {
                    "emptyTable": "Data tidak ditemukan"
                },
                "searching": false,
                "ordering": false,
                "bSortClasses": false,
                ajax: {
                    url: "{{ route('sales.dataSales') }}",
                    'data': function(data) {
                        data._token = "{{ csrf_token() }}";
                    },
                    method: 'POST'
                },

                columns: [
                    {
                        data: 'name'
                    },
                    {
                        data: 'username'
                    },
                    {
                        data: 'jabatan'
                    },
                    {
                        data: 'hp'
                    },
                    {
                        "targets": 0,
                        "width": "15%",
                        "data": null,
                        "defaultContent": `<button class="btn btn-danger btn-xs delsales" ><i class="bi bi-trash"></i></button> <button class="btn btn-primary btn-xs editsales" ><i class="bi bi-pencil-square"></i> </button>`
                    }
                ]
            });

            var table = $('#datasales').DataTable();
            table.on('click', '.delsales', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const response = fetch(
                            "{{ route('sales.delete') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                'body': JSON.stringify({
                                    '_token': "{{ csrf_token() }}",
                                    'id': data.id,
                                })
                            }).then(response => response.json()).then(data => {
                            if (data.status == 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        table.ajax.reload();
                                    }
                                })
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    'Your file failed to delete.',
                                    'error'
                                )
                            }
                        })

                    }
                })
                // $('#modal-hpssales').modal('show');
                // $('#hapusid').html(data.id);
                // $('#hapuscabang').html(data.kode_cabang);
                // $('#hapusnama').html(data.name);
                // document.getElementById('recid').value = data.id;
            });
            table.on('click', '.editsales', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                $('#modal-editsales').modal('show');
                $('#pesanerror').html('');
                $("#editnama").val(data.name)
                $("#editusername").val(data.username)
                $("#editjabatan").val(data.jabatan_id)
                $("#edithp").val(data.hp)
                $("#editjabatan").select2({
                    placeholder: 'Select Item',
                    width: '100%',
                    dropdownParent: $('#modal-editsales .modal-content')
                }).val(data.jabatan_id).trigger('change');
            });

<<<<<<< HEAD

            $('#btn_editsales').on('click', function(event) {
                var isvalidate = $("#formEditStatus")[0].checkValidity();
                if (isvalidate) {
                    event.preventDefault();
                    var username = $("#editusername").val();
                    var jabatan = $("#editjabatan").val();
                    var hp = $("#edithp").val();
                    var password = $("#editpassword").val();
                    var password_confirmation = $("#editpassword_confirmation").val();
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('editpasswordsales') }}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            username,
                            jabatan,
                            hp,
                            password,
                            password_confirmation
                        },
                        cache: false,
                        success: function(response) {
                            console.log(response);
=======
            $('#btn_editsales').on('click', function(e) {
                e.preventDefault();
                var dataForm = $("#formEditSales").serialize()
                $.ajax({
                    type: 'POST',
                    url: "{{ route('sales.updateSales') }}",
                    data: dataForm,
                    cache: false,
                    success: function(response) {
                        console.log(response);
                        if (response.status == 200) {
>>>>>>> 92bc7915d37b5684793e00835b50c46265d1774f
                            $('#modal-editsales').modal('hide');
                            $('#datasales').DataTable().ajax.reload();
                            toastr.success('Data has been saved', 'Success');
                        } else {
                            toastr.error('Data failed to save','Error');
                        }
                    },
                });
            });
        });
    </script>

      <script>
               $("#closeBtn").on("click", function() {
  $("#modal-berhasiledit").modal('hide');
});

$("#batalBtn").on("click", function() {
  $("#modal-editsales").modal('hide');
});

$("#batalBtn").on("click", function() {
  $("#modal-hpssales").modal('hide');
});

$(".close").on("click", function() {
  $("#modal-hpssales").modal('hide');
});

    </script>
@stop
