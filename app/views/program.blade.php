@section('content')
<h1 class="page-header">
	Daftar Calon PDB Program {{ $program }}
	<a href="{{ action('StudentController@exportProgramExcel', $program) }}" class="btn btn-success pull-right"><span class="glyphicon glyphicon-export"></span> Ekspor ke Excel</a>
</h1>
@if( $students->isEmpty() )
<div class="alert alert-info">Belum ada Calon PDB yang mendaftar</div>
@else
<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<th>No. Pendaftaran</th>
			<th>Nama</th>
			<th>Asal Sekolah</th>
			<th>Nilai Raport</th>
			<th>Nilai UN</th>
			<th>Nilai Umum</th>
			<th>Nilai Total</th>
			<th>Diterima di</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $students as $item )
		<tr>
			<td>{{ $item->reg_number }}</td>
			<td>{{ $item->name }}</td>
			<td>{{ $item->school_name }}</td>
			@if( $item->score_total_1 >= $item->score_total_2 )
			<td>{{ $item->score_raport_1 }}</td>
			<td>{{ $item->score_un_1 }}</td>
			<td>{{ $item->score_umum_1 }}</td>
			<td>{{ $item->score_total_1 }}</td>
			@else
			<td>{{ $item->score_raport_2 }}</td>
			<td>{{ $item->score_un_2 }}</td>
			<td>{{ $item->score_umum_2 }}</td>
			<td>{{ $item->score_total_2 }}</td>
			@endif
			<td>{{ $item->suggestion }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endif
@stop