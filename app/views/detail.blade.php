@section('content')
<h2 class="page-header">
	{{ $student->name }} <small>{{ $student->reg_number }} - {{ $student->school_name }}</small>
	<div class="btn-group pull-right">
		{{ HTML::linkAction('StudentController@showEdit', 'Sunting', array($student->id), array('class' => 'btn btn-warning')); }}
		{{ HTML::linkAction('StudentController@showAll', 'Kembali', null, array('class' => 'btn btn-default')); }}
	</div>
</h2>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title text-center">Kelompok Peminatan yang disarankan adalah</h3>
	</div>
	<div class="panel-body">
		<h3 class="text-center">{{ $student->suggestion }}</h3>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="panel {{ $student->score_total_1 >= $student->score_total_2 ? 'panel-primary' : 'panel-info' }}">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Pilihan I</h3>
			</div>
			<ul class="list-group text-center">
				<li class="list-group-item"><strong>{{ $student->program_1 }} {{ $student->program_1 != 'Reguler' ? '' : $student->group_1 }}</strong></li>
				<li class="list-group-item"><h3>{{ $student->score_total_1 }}</h3></li>
				<li class="list-group-item">Kriteria Nilai Raport: <strong>{{ $student->score_raport_1 }}</strong></li>
				<li class="list-group-item">Kriteria Nilai UN: <strong>{{ $student->score_un_1 }}</strong></li>
				<li class="list-group-item">Kriteria Nilai Umum: <strong>{{ $student->score_umum_1 }}</strong></li>
			</ul>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="panel {{ $student->score_total_1 <= $student->score_total_2 ? 'panel-primary' : 'panel-info' }}">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Pilihan II</h3>
			</div>
			<ul class="list-group text-center">
				<li class="list-group-item"><strong>{{ $student->program_2 }} {{ $student->program_2 != 'Reguler' ? '' : $student->group_2 }}</strong></li>
				<li class="list-group-item"><h3>{{ $student->score_total_2 }}</h3></li>
				<li class="list-group-item">Kriteria Nilai Raport: <strong>{{ $student->score_raport_2 }}</strong></li>
				<li class="list-group-item">Kriteria Nilai UN: <strong>{{ $student->score_un_2 }}</strong></li>
				<li class="list-group-item">Kriteria Nilai Umum: <strong>{{ $student->score_umum_2 }}</strong></li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<table class="table table-bordered table-condensed">
			<thead>
				<tr class="success">
					<th class="text-center" colspan="6">Nilai Raport</th>
					<th class="text-center" colspan="4">Nilai UN</th>
					<th class="text-center" colspan="3">Nilai Kompetensi Umum</th>
				</tr>
				<tr class="success">
					<th>P. Agama Islam</th>
					<th>B. Indonesia</th>
					<th>B. Inggris</th>
					<th>Matematika</th>
					<th>IPA</th>
					<th>IPS</th>
					<th>B. Indonesia</th>
					<th>B. Inggris</th>
					<th>Matematika</th>
					<th>IPA</th>
					<th>Tes Akademik</th>
					<th>BTA</th>
					<th>IQ</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{ $student->raport_pai }}</td>
					<td>{{ $student->raport_bin }}</td>
					<td>{{ $student->raport_big }}</td>
					<td>{{ $student->raport_mtk }}</td>
					<td>{{ $student->raport_ipa }}</td>
					<td>{{ $student->raport_ips }}</td>
					<td>{{ $student->un_bin }}</td>
					<td>{{ $student->un_big }}</td>
					<td>{{ $student->un_mtk }}</td>
					<td>{{ $student->un_ipa }}</td>
					<td>{{ $student->akademik }}</td>
					<td>{{ $student->bta }}</td>
					<td>{{ $student->iq }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@stop