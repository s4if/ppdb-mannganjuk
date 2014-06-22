<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Xompatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ $title }} | PPDB MAN Nganjuk</title>
		<link rel="shortcut icon" href="{{ URL::to('/') }}/favicon.ico">
		{{ HTML::style('css/bootstrap.css') }}
		{{ HTML::style('css/dashboard.css') }}
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		   <div class="container-fluid">
		     <div class="navbar-header">
		       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		         <span class="sr-only">Toggle navigation</span>
		         <span class="icon-bar"></span>
		         <span class="icon-bar"></span>
		         <span class="icon-bar"></span>
		       </button>
		       <a class="navbar-brand" href="#">PPDB MAN Nganjuk 2014/2015</a>
		     </div>
		     <div class="navbar-collapse collapse">
		       <ul class="nav navbar-nav navbar-right">
		         <li>{{ HTML::linkAction('HomeController@showDashboard', 'Beranda') }}</li>
		         <li>{{ HTML::linkAction('HomeController@showSettings', 'Pengaturan') }}</li>
		       </ul>
		     </div>
		   </div>
		</div>

	   <div class="container-fluid">
	      <div class="row">
	      	<div class="col-sm-3 col-md-2 sidebar">
	      		<ul class="nav nav-sidebar">
	      			<li class="{{ Request::is('/') ? 'active' : '' }}"><a href="#"><span class="glyphicon glyphicon-user"></span> Calon PDB</a></li>
	      			<li class="{{ Request::is('peserta') ? 'active' : '' }}"><a href="{{ action('StudentController@showAll') }}"><span class="glyphicon glyphicon-list"></span> Semua</a></li>
	      			<li class="{{ Request::is('peserta/baru') ? 'active' : '' }}"><a href="{{ action('StudentController@addNew') }}"><span class="glyphicon glyphicon-plus"></span> Baru</a></li>
	      		</ul>
	      		<ul class="nav nav-sidebar">
	      			<li>{{ HTML::linkAction('StudentController@showProgram', 'Tahfidh', array('Tahfidh')) }}</li>
	      			<li>{{ HTML::linkAction('StudentController@showProgram', 'Akselerasi', array('Akselerasi')) }}</li>
	      			<li>{{ HTML::linkAction('StudentController@showProgram', 'BCA', array('BCA')) }}</li>
	      			<li>{{ HTML::linkAction('StudentController@showProgram', 'BCS', array('BCS')) }}</li>
	      			<li>{{ HTML::linkAction('StudentController@showProgram', 'Reguler', array('Reguler')) }}</li>
	      		</ul>
	      	</div>
	      	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	      	@if( Session::has('success') )
				<div class="alert alert-success alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
					{{ Session::get('success') }}
				</div>
	      	@endif
	      	@if( Session::has('danger') )
				<div class="alert alert-danger alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
					{{ Session::get('danger') }}
				</div>
	      	@endif
	      	@yield('content')
	      	</div>
	      </div>
	    </div>

	  	{{ HTML::script('js/jquery.js') }}
	   {{ HTML::script('js/bootstrap.js') }}
	   {{ HTML::script('js/placeholder.js') }}
	   {{ HTML::script('js/app.js') }}
	</body>
</html>