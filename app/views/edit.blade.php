@section('content')
{{ Form::open(array('action' => 'StudentController@storeEdit')) }}
<div class="row">
	<div class="col-sm-6">
		<fieldset>
			<legend>Biodata</legend>
			{{ Form::hidden('id', $student->id) }}
			<div class="form-group {{ ! $errors->first('name') ?: 'has-error' }}">
				{{ Form::label('name', 'Nama Lengkap', array('class' => 'control-label')) }}
				{{ Form::text('name', $student->name, array('required', 'class' => 'form-control')) }}
				{{ $errors->first('name', '<span class="help-block text-danger">Harus diisi</span>') }}
			</div>
			<div class="form-group {{ ! $errors->first('school_name') ?: 'has-error' }}">
				{{ Form::label('school_name', 'Asal Sekolah', array('class' => 'control-label')) }}
				{{ Form::text('school_name', $student->school_name, array('required', 'class' => 'form-control')) }}
				@if( $errors->first('school_name') )
				<span class="help-block text-danger">Harus diisi</span>
				@endif
			</div>
			<div class="form-group">
				{{ Form::label('program_1', 'Program Pilihan I', array('class' => 'control-label')) }}
				<div class="row">
					<div class="col-sm-6">
						{{ Form::select('program_1', $program, $student->program_1, array('class' => 'form-control')) }}
					</div>
					<div class="col-sm-6">
						{{ Form::select('group_1', array('AGAMA' => 'AGAMA', 'IPA' => 'IPA', 'IPS' => 'IPS'), $student->program_1 != 'reguler' ?: $student->group_1, array($student->program_1 != 'reguler' ? 'disabled' : '', 'id' => 'group_1', 'class' => 'form-control')) }}
					</div>
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('program_2', 'Program Pilihan II', array('class' => 'control-label')) }}
				<div class="row">
					<div class="col-sm-6">
						{{ Form::select('program_2', $program, $student->program_2, array('class' => 'form-control')) }}
					</div>
					<div class="col-sm-6">
						{{ Form::select('group_2', array('AGAMA' => 'AGAMA', 'IPA' => 'IPA', 'IPS' => 'IPS'), $student->program_2 != 'reguler' ?: $student->group_2, array($student->program_1 != 'reguler' ? 'disabled' : '', 'id' => 'group_2', 'class' => 'form-control')) }}
					</div>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Nilai Rata-rata Raport</legend>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						{{ Form::text('raport_pai', $student->raport_pai, array('placeholder' => 'PAI', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-2">
						{{ Form::text('raport_bin', $student->raport_bin, array('placeholder' => 'BIN', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-2">
						{{ Form::text('raport_big', $student->raport_big, array('placeholder' => 'BIG', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-2">
						{{ Form::text('raport_mtk', $student->raport_mtk, array('placeholder' => 'MTK', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-2">
						{{ Form::text('raport_ipa', $student->raport_ipa, array('placeholder' => 'IPA', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-2">
						{{ Form::text('raport_ips', $student->raport_ips, array('placeholder' => 'IPS', 'class' => 'form-control')) }}
					</div>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Nilai UN</legend>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						{{ Form::text('un_bin', $student->un_bin, array('placeholder' => 'BIN', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-3">
						{{ Form::text('un_big', $student->un_big, array('placeholder' => 'BIG', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-3">
						{{ Form::text('un_mtk', $student->un_mtk, array('placeholder' => 'MTK', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-3">
						{{ Form::text('un_ipa', $student->un_ipa, array('placeholder' => 'IPA', 'class' => 'form-control')) }}
					</div>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Nilai Kompetensi Umum</legend>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						{{ Form::text('akademik', $student->akademik, array('placeholder' => 'Tes Akademik', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-4">
						{{ Form::text('bta', $student->bta, array('placeholder' => 'BTA', 'class' => 'form-control')) }}
					</div>
					<div class="col-sm-4">
						{{ Form::text('iq', $student->iq, array('placeholder' => 'IQ', 'class' => 'form-control')) }}
					</div>
				</div>
			</div>
		</fieldset>
		{{ Form::submit('Simpan Perubahan', array('class' => 'btn btn-success btn-lg pull-right')) }}
	</div>
	<div class="col-sm-6">
		@if(Session::has('errors'))
		<ul class="list-group">
			<li class="list-group-item list-group-item-danger">{{ $errors->first('akademik', 'Kolom Tes Akademik bernilai 0-100') }}</li>
			<li class="list-group-item list-group-item-danger">{{ $errors->first('bta', 'Kolom BTA bernilai 0-100') }}</li>
			<li class="list-group-item list-group-item-danger">{{ $errors->first('iq', 'Kolom IQ bernilai 0-300') }}</li>
		</ul>
		@endif
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Catatan</h3>
			</div>
			<ul class="list-group">
				<li class="list-group-item">Program pilihan <strong>selain Reguler</strong> secara <strong>otomatis akan dikelompokkan sesuai kelompok peminatannya</strong>.</li>
				<li class="list-group-item">Nilai raport menggunakan skala 1-100 dan <strong>desimal dipisah dengan tanda titik</strong>. Jika nilai Calon PDB adalah <strong>8.89</strong>, maka diisi dengan <strong>88.9</strong></li>
			</ul>
		</div>
	</div>
</div>
{{ Form::close() }}
@stop