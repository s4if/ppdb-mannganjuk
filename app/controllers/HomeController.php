<?php

class HomeController extends BaseController
{
	protected $layout = 'layout';
	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	/**
	 * Tampilkan halaman beranda.
	 *
	 * @return void
	 */
	public function showDashboard()
	{
		$this->layout->title = 'Selamat Datang';
		$this->layout->content = View::make('dashboard');
	}

	/**
	 * Tampilkan halaman pengaturan.
	 *
	 * @return void
	 */
	public function showSettings()
	{
		$data = array();
		$data['settings'] = DB::table('settings')->first();

		$this->layout->title = 'Pengaturan';
		$this->layout->content = View::make('settings', $data);
	}

	/**
	 * Simpan perubahan pengaturan.
	 *
	 * @return void
	 */
	public function storeSettings()
	{
		$data = Input::all();
		$rules = array(
			'core' => 'required|numeric|min:10|max:90',
			'secondary' => 'required|numeric|min:10|max:90',
			'raport' => 'required|numeric|min:10|max:90',
			'un' => 'required|numeric|min:10|max:90',
			'umum' => 'required|numeric|min:10|max:90',
		);

		$val = Validator::make($data, $rules);

		if ($val->fails())
		{
			return Redirect::action('HomeController@showSettings')->withErrors($val);
		}
		else
		{
			if ( $data['core'] + $data['secondary'] != 100 )
			{
				return Redirect::action('HomeController@showSettings')->withDanger('Jumlah core factor dan secondary factor harus sama dengan 100');
			}
			if ( $data['raport'] + $data['un'] + $data['umum'] != 100 )
			{
				return Redirect::action('HomeController@showSettings')->withDanger('Jumlah kriteria nilai raport, nilai UN, dan nilai kompetensi umum harus sama dengan 100');
			}

			$items = array(
				'core' => $data['core'],
				'secondary' => $data['secondary'],
				'raport' => $data['raport'],
				'un' => $data['un'],
				'umum' => $data['umum'],
			);
			$query = DB::table('settings')->where('id', 1);

			if ($query->update($items))
			{
				return Redirect::action('HomeController@showSettings')->withSuccess('Perubahan telah disimpan');
			}
			else
			{
				return Redirect::action('HomeController@showSettings')->withDanger('Gagal menyimpan perubahan');
			}
		}
	}
}
