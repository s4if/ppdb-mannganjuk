@section('content')
<h1>Memulai aplikasi PPDB</h1>
<p class="lead">Menggunakan aplikasi PPDB MAN Nganjuk sangat mudah. Anda dapat mengakses menu melalui panel di samping atau melalui akses cepat di bawah ini. Kegiatan apa yang akan Anda lakukan saat ini?</p>
<div class="row">
	<div class="col-sm-4">
		<a href="{{ action('StudentController@showAll') }}" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-list"></span> Daftar Calon PDB</a>
	</div>
	<div class="col-sm-4">
		<a href="{{ action('StudentController@addNew') }}" class="btn btn-lg btn-success btn-block"><span class="glyphicon glyphicon-plus"></span> Tambah Data Calon PDB</a>
	</div>
	<div class="col-sm-4">
		<div class="input-group">
	      <?php echo Form::text('data', null, array('placeholder' => 'No. Pendaftaran', 'id' => 'search-input', 'class' => 'form-control input-lg')) ?>
	      <span class="input-group-btn">
	        <button type="button" id="search-button" class="btn btn-lg btn-default">Cari</button>
	      </span>
	    </div>
	</div>
</div>
@stop