@section('content')
<h3 class="page-header">Pengaturan Profile Matching</h3>
<div class="row">
	<div class="col-sm-4">
		{{ Form::open() }}
		<div class="form-group {{ ! $errors->first('core') ?: 'has-error' }}">
			{{ Form::label('core', 'Core Factor', array('class' => 'control-label')) }}
			<div class="input-group">
				{{ Form::text('core', $settings->core, array('required', 'class' => 'form-control')) }}
				<span class="input-group-addon">%</span>		
			</div>	
			{{ $errors->first('core', '<span>Harus diisi dan bernilai 10-90</span>') }}
		</div>
		<div class="form-group {{ ! $errors->first('secondary') ?: 'has-error' }}">
			{{ Form::label('secondary', 'Secondary Factor', array('class' => 'control-label')) }}
			<div class="input-group">
				{{ Form::text('secondary', $settings->secondary, array('required', 'class' => 'form-control')) }}
				<span class="input-group-addon">%</span>
			</div>
			{{ $errors->first('secondary', '<span>Harus diisi dan bernilai 10-90</span>') }}
		</div>
		<div class="form-group {{ ! $errors->first('raport') ?: 'has-error' }}">
			{{ Form::label('raport', 'Kriteria Nilai Raport', array('class' => 'control-label')) }}
			<div class="input-group">
				{{ Form::text('raport', $settings->raport, array('required', 'class' => 'form-control')) }}
				<span class="input-group-addon">%</span>
			</div>
			{{ $errors->first('raport', '<span>Harus diisi dan bernilai 10-90</span>') }}
		</div>
		<div class="form-group {{ ! $errors->first('un') ?: 'has-error' }}">
			{{ Form::label('un', 'Kriteria Nilai UN', array('class' => 'control-label')) }}
			<div class="input-group">
				{{ Form::text('un', $settings->un, array('required', 'class' => 'form-control')) }}
				<span class="input-group-addon">%</span>
			</div>
			{{ $errors->first('un', '<span>Harus diisi dan bernilai 10-90</span>') }}
		</div>
		<div class="form-group {{ ! $errors->first('umum') ?: 'has-error' }}">
			{{ Form::label('umum', 'Kriteria Nilai Kompetensi Umum', array('class' => 'control-label')) }}
			<div class="input-group">
				{{ Form::text('umum', $settings->umum, array('required', 'class' => 'form-control')) }}
				<span class="input-group-addon">%</span>
			</div>
			{{ $errors->first('umum', '<span>Harus diisi dan bernilai 10-90</span>') }}
		</div>
		{{ Form::submit('Simpan Perubahan', array('class' => 'btn btn-success btn-lg pull-right')) }}
		{{ Form::close() }}
	</div>
	<div class="col-sm-8">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Catatan</h3>
			</div>
			<ul class="list-group">
				<li class="list-group-item"><strong>Core Factor</strong> adalah faktor-faktor yang paling berpengaruh terhadap suatu penilaian dalam suatu kriteria.</li>
				<li class="list-group-item"><strong>Secondary Factor</strong> adalah faktor-faktor pendukung terhadap suatu penilaian dalam suatu kriteria.</li>
			</ul>
		</div>
	</div>
</div>
@stop