<!-- modal hapus Sales -->
<div class="modal modal-danger fade" id="modal-hpssales">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Hapus Data Sales</h4>
			</div>
			<div class="modal-body text-cente">
				<p class="col-sm-offset-3"><h4><label id="hapusid" hidden></label>	 <br>
				Cabang :	 <label id="hapuscabang"></label><br>
				Nama Sales :	 <label id="hapusnama"></label> </h4></p>
				nb : jika data dihapus, Sales yang bersangkutan tidak bisa login.
			</div>
			<div class="modal-footer">
				<input type="hidden" id='recid'>
				<button type="button" class="btn btn-outline-primary" id="hpsstoremanager">Ok,fine&hellip;</button>
				<button type="button" class="btn btn-outline-danger pull-left" id="batalBtn" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>

{{-- <div class="modal alert alert-danger alert-dismissible fade" role="alert" id="modal-hpssales">
    <h4 class="alert-heading">Danger Heading</h4>
    <p>Et suscipit deserunt earum itaque dignissimos recusandae dolorem qui. Molestiae rerum perferendis laborum. Occaecati illo at laboriosam rem molestiae sint.</p>
    <hr>
    <p class="mb-0">Temporibus quis et qui aspernatur laboriosam sit eveniet qui sunt.</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    <div class="modal-footer">
        <input type="hidden" id='recid'>
        <button type="button" class="btn btn-outline-primary" id="hpsstoremanager">Ok,fine&hellip;</button>
        <button type="button" class="btn btn-outline-danger pull-left" id="batalBtn" data-dismiss="modal">Batal</button>
    </div>
  </div> --}}

<!-- ///// modal edit Sales -->
<div class="modal modal-default fade" id="modal-editsales" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<form class="form-horizontal" role="form" id="formEditSales">
			{{ csrf_field() }}
				<div class="modal-header">
					<h4 class="modal-title">Form Sales <label id="id_cccstatus" class="pull-right"></label></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-3">
							<label for="inputsm" class="control-label">Nama</label>
						</div>
						<div class="col-sm-9" >
							<input name="editnama" id="editnama" class="form-control input-sm" autocomplete="off">
						</div>
					</div>
					</br>
					<div class="row">
						<div class="col-sm-3">
							<label for="inputsm" class="control-label">Username</label>
						</div>
						<div class="col-sm-9" >
							<input name="editusername" id="editusername" class="form-control input-sm" autocomplete="off">
						</div>
					</div>
					</br>
					<div class="row">
						<div class="col-sm-3">
							<label class="control-label">Jabatan</label>
						</div>
						<div class="col-sm-9">
							<select name="editjabatan" id="editjabatan" class="form-control select2 js-basic" required>
							<option value="" selected>Pilih Jabatan</option>
							@foreach($jabatans as $jabatan)
							<option value="{{$jabatan->id}}">{{$jabatan->name}}</option>
							@endforeach
							</select>
						</div>
					</div>
					</br>
					<div class="row">
						<div class="col-sm-3">
							<label class="control-label">WA / Hp </label>
						</div>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="edithp" name="edithp" maxlength="12" oninput="this.value=this.value.replace(/[^0-9]/g,'');" autocomplete="off" placeholder="harus diisi" value="{{ old('hp') }}" required="" pattern=".{10,12}">
							@if ($errors->has('hp'))
							<span class="help-block">
								<strong>{{ $errors->first('hp') }}</strong>
							</span>
							@endif
						</div>
					</div>
				<!-- <div class="form-group">
					<label class="col-sm-3 control-label">Password</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="editpassword" id="editpassword" placeholder="kosongkan bila tidak ingin ganti password" onKeyUp="caps(this)" autocomplete="off" >
						@if ($errors->has('password'))
								<span class="help-block">
										<strong>{{ $errors->first('password') }}</strong>
								</span>
						@endif
					</div>
				</div> -->
				<!-- <div class="form-group">
					<label for="password-confirm" class="col-sm-3 control-label">Confirm Password</label>
					<div class="col-sm-9">
							<input id="editpassword_confirmation" type="password" class="form-control" name="editpassword_confirmation" onKeyUp="caps(this)" >
							<div id="pesanerror"></div>
					</div>
				</div> -->
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success" id="btn_editsales">Simpan</button>
					<button type="button" class="btn btn-danger pull-left batal" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- modal Sukses -->
<div class="modal modal-info fade" id="modal-berhasiledit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                Update Data Berhasil.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" id="closeBtn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
