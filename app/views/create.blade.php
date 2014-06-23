@section('content')
{{ Form::open() }}
<div class="row">
	<div class="col-sm-6">
		<fieldset>
			<legend>Biodata Calon PDB</legend>
			<div class="form-group">
				{{ Form::label('no_pendaftaran', 'No. Pendaftaran', array('class' => 'control-label')) }}
				{{ Form::text(null, $nomor, array('disabled', 'class' => 'form-control')) }}
				{{ Form::hidden('no_pendaftaran', $nomor) }}
			</div>
			<div class="form-group {{ ! $errors->first('name') ?: 'has-error' }}">
				{{ Form::label('name', 'Nama Lengkap', array('class' => 'control-label')) }}
				{{ Form::text('name', Input::old('name'), array('autofocus', 'required', 'class' => 'form-control')) }}
				@if( $errors->first('name') )
				<span class="help-block text-danger">Harus diisi</span>
				@endif
			</div>
			<div class="form-group {{ ! $errors->first('school_name') ?: 'has-error' }}">
				{{ Form::label('school_name', 'Asal Sekolah', array('class' => 'control-label')) }}
				{{ Form::text('school_name', Input::old('school_name'), array('required', 'class' => 'form-control')) }}
				@if( $errors->first('school_name') )
				<span class="help-block text-danger">Harus diisi</span>
				@endif
			</div>
			<div class="form-group">
				{{ Form::label('program_1', 'Program Pilihan I', array('class' => 'control-label')) }}
				<div class="row">
					<div class="col-sm-6">
						{{ Form::select('program_1', $program, Input::old('program_1'), array('class' => 'form-control')) }}
					</div>
					<div class="col-sm-6">
						{{ Form::select('group_1', array('AGAMA' => 'AGAMA', 'IPA' => 'IPA', 'IPS' => 'IPS'), Input::old('group_1'), array('disabled', 'id' => 'group_1', 'class' => 'form-control')) }}
					</div>
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('program_2', 'Program Pilihan II', array('class' => 'control-label')) }}
				<div class="row">
					<div class="col-sm-6">
						{{ Form::select('program_2', $program, Input::old('program_2'), array('class' => 'form-control')) }}
					</div>
					<div class="col-sm-6">
						{{ Form::select('group_2', array('AGAMA' => 'AGAMA', 'IPA' => 'IPA', 'IPS' => 'IPS'), Input::old('group_2'), array('disabled', 'id' => 'group_2', 'class' => 'form-control')) }}
					</div>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Nilai Rata-rata Raport</legend>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						{{ Form::text('raport_pai', Input::old('raport_pai'), array('placeholder' => 'PAI', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-2">
						{{ Form::text('raport_bin', Input::old('raport_bin'), array('placeholder' => 'BIN', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-2">
						{{ Form::text('raport_big', Input::old('raport_big'), array('placeholder' => 'BIG', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-2">
						{{ Form::text('raport_mtk', Input::old('raport_mtk'), array('placeholder' => 'MTK', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-2">
						{{ Form::text('raport_ipa', Input::old('raport_ipa'), array('placeholder' => 'IPA', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-2">
						{{ Form::text('raport_ips', Input::old('raport_ips'), array('placeholder' => 'IPS', 'class' => 'form-control')) }}
					</div>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Nilai UN</legend>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						{{ Form::text('un_bin', Input::old('un_bin'), array('placeholder' => 'BIN', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-3">
						{{ Form::text('un_big', Input::old('un_big'), array('placeholder' => 'BIG', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-3">
						{{ Form::text('un_mtk', Input::old('un_mtk'), array('placeholder' => 'MTK', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-3">
						{{ Form::text('un_ipa', Input::old('un_ipa'), array('placeholder' => 'IPA', 'class' => 'form-control')) }}
					</div>
				</div>
			</div>
		</fieldset>
		{{ Form::submit('Tambahkan', array('class' => 'btn btn-primary btn-lg pull-right')) }}
	</div>
	<div class="col-sm-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Catatan</h3>
			</div>
			<ul class="list-group">
				<li class="list-group-item">Program pilihan <strong>selain Reguler</strong> secara <strong>otomatis akan dikelompokkan sesuai kelompok peminatannya</strong>.</li>
				<li class="list-group-item">Nilai raport menggunakan skala 1-100  dan <strong>desimal dipisah dengan tanda titik</strong>. Jika nilai Calon PDB adalah <strong>8.89</strong>, maka diisi dengan <strong>88.9</strong></li>
				<li class="list-group-item">Anda dapat mengosongkan nilai raport dan nilai UN, dan mengisinya nanti.</li>
			</ul>
		</div>
	</div>
</div>
{{ Form::close() }}
@stop