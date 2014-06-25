<?php

class StudentController extends BaseController
{
	protected $layout = 'layout';

	public function __construct(Student $student)
	{
		$this->beforeFilter('csrf', array('on' => 'POST'));
		$this->student = $student;
	}

	/**
	 * Tampilkan daftar Calon PDB.
	 *
	 * @return void
	 */
	public function showAll()
	{
		$data = array();
		$data['students'] = $this->student->all();

		$this->layout->title = 'Daftar Calon PDB';
		$this->layout->content = View::make('list', $data);
	}

	/**
	 * Tampilkan daftar Calon PDB sesuai program kelas.
	 *
	 * @param  string $program
	 * @return void
	 */
	public function showProgram($program = null)
	{
		$data = array();
		$data['students'] = $this->student->where('program_1', $program)->get();
		$data['program'] = $program;

		$this->layout->title = 'Daftar Calon PDB Program '.$program;
		$this->layout->content = View::make('program', $data);
	}

	/**
	 * Tampilkan data Calon PDB.
	 *
	 * @param  integer $id
	 * @return void
	 */
	public function showDetail($id = null)
	{
		$data = array();
		$student = $this->student->find($id);
		$data['student'] = $student;

		$this->layout->title = $student->name;
		$this->layout->content = View::make('detail', $data);
	}

	/**
	 * Tampilkan halaman sunting data Calon PDB.
	 *
	 * @param  integer $id
	 * @return void
	 */
	public function showEdit($id = null)
	{
		if ( $student = $this->student->find($id) )
		{
			$data = array();
			$data['student'] = $student;
			$data['program'] = array('Tahfidh' => 'Tahfidh', 'Akselerasi' => 'Akselerasi', 'BCA' => 'BCA', 'BCS' => 'BCS', 'Reguler' => 'Reguler');

			$this->layout->title = $student->name;
			$this->layout->content = View::make('edit', $data);
		}
		else
		{
			return Redirect::action('StudentController@showAll')->withDanger('Maaf, kami tidak dapat menemukan Calon PDB dengan nomor pendaftaran #'.$id);
		}
	}

	/**
	 * Simpan perubahan data Calon PDB.
	 *
	 * @return void
	 */
	public function storeEdit()
	{
		$id = Input::get('id');

		if ( $peserta = $this->student->find($id) )
		{
			// Validasi masukan
			$data = array(
				'name' => Input::get('name'),
				'school_name' => Input::get('school_name'),
				'akademik_pai' => Input::get('akademik_pai'),
				'akademik_bin' => Input::get('akademik_bin'),
				'akademik_big' => Input::get('akademik_big'),
				'akademik_mtk' => Input::get('akademik_mtk'),
				'akademik_ipa' => Input::get('akademik_ipa'),
				'akademik_ips' => Input::get('akademik_ips'),
				'bta' => Input::get('bta'),
			);
			$rules = array(
				'name' => 'required',
				'school_name' => 'required',
				'akademik_pai' => 'numeric|min:0|max:15',
				'akademik_bin' => 'numeric|min:0|max:10',
				'akademik_big' => 'numeric|min:0|max:10',
				'akademik_mtk' => 'numeric|min:0|max:10',
				'akademik_ipa' => 'numeric|min:0|max:10',
				'akademik_ips' => 'numeric|min:0|max:15',
				'bta' => 'numeric|min:0|max:100',
			);
			$val = Validator::make($data, $rules);

			if ($val->fails())
			{
				return Redirect::action('StudentController@showEdit', array($id))->withInput()->withErrors($val);
			}
			else
			{
				// Beri nilai awal pada nilai-nilai
				$pilihan_1 = $this->pilihMinat(Input::get('program_1'), Input::get('group_1'));
				$pilihan_2 = $this->pilihMinat(Input::get('program_2'), Input::get('group_2'));
				$raport_pai = is_null(Input::get('raport_pai')) ? 0 : round(Input::get('raport_pai')/10);
				$raport_bin = is_null(Input::get('raport_bin')) ? 0 : round(Input::get('raport_bin')/10);
				$raport_big = is_null(Input::get('raport_big')) ? 0 : round(Input::get('raport_big')/10);
				$raport_mtk = is_null(Input::get('raport_mtk')) ? 0 : round(Input::get('raport_mtk')/10);
				$raport_ipa = is_null(Input::get('raport_ipa')) ? 0 : round(Input::get('raport_ipa')/10);
				$raport_ips = is_null(Input::get('raport_ips')) ? 0 : round(Input::get('raport_ips')/10);
				$un_bin = is_null(Input::get('un_bin')) ? 0 : round(Input::get('un_bin'));
				$un_big = is_null(Input::get('un_big')) ? 0 : round(Input::get('un_big'));
				$un_mtk = is_null(Input::get('un_mtk')) ? 0 : round(Input::get('un_mtk'));
				$un_ipa = is_null(Input::get('un_ipa')) ? 0 : round(Input::get('un_ipa'));
				$akademik_pai = is_null(Input::get('akademik_pai')) ? 0 : round((Input::get('akademik_pai')/15)*10);
				$akademik_bin = is_null(Input::get('akademik_bin')) ? 0 : round((Input::get('akademik_bin')/10)*10);
				$akademik_big = is_null(Input::get('akademik_big')) ? 0 : round((Input::get('akademik_big')/10)*10);
				$akademik_mtk = is_null(Input::get('akademik_mtk')) ? 0 : round((Input::get('akademik_mtk')/10)*10);
				$akademik_ipa = is_null(Input::get('akademik_ipa')) ? 0 : round((Input::get('akademik_ipa')/10)*10);
				$akademik_ips = is_null(Input::get('akademik_ips')) ? 0 : round((Input::get('akademik_ips')/15)*10);
				$bta = is_null(Input::get('bta')) ? 0 : round(Input::get('bta')/10);

				// Data yang akan disimpan
				$peserta->name = Input::get('name');
				$peserta->school_name = Input::get('school_name');
				$peserta->program_1 = Input::get('program_1');
				$peserta->group_1 = $pilihan_1;
				$peserta->program_2 = Input::get('program_2');
				$peserta->group_2 = $pilihan_2;
				$peserta->raport_pai = Input::get('raport_pai');
				$peserta->raport_bin = Input::get('raport_bin');
				$peserta->raport_big = Input::get('raport_big');
				$peserta->raport_mtk = Input::get('raport_mtk');
				$peserta->raport_ipa = Input::get('raport_ipa');
				$peserta->raport_ips = Input::get('raport_ips');
				$peserta->raport_ips = Input::get('raport_ips');
				$peserta->avg_raport = $this->hitungRata2Raport($raport_pai, $raport_bin, $raport_big, $raport_mtk, $raport_ipa, $raport_ips);
				$peserta->un_bin = Input::get('un_bin');
				$peserta->un_big = Input::get('un_big');
				$peserta->un_mtk = Input::get('un_mtk');
				$peserta->un_ipa = Input::get('un_ipa');
				$peserta->un_avg = $this->hitungRata2UN(Input::get('un_bin'), Input::get('un_big'), Input::get('un_mtk'), Input::get('un_ipa'));
				$peserta->tes_pai = Input::get('akademik_pai');
				$peserta->tes_bin = Input::get('akademik_bin');
				$peserta->tes_big = Input::get('akademik_big');
				$peserta->tes_mtk = Input::get('akademik_mtk');
				$peserta->tes_ipa = Input::get('akademik_ipa');
				$peserta->tes_ips = Input::get('akademik_ips');
				$peserta->tes_ips = Input::get('akademik_ips');
				$peserta->akademik_pai = (Input::get('akademik_pai')/15)*10;
				$peserta->akademik_bin = (Input::get('akademik_bin')/10)*10;
				$peserta->akademik_big = (Input::get('akademik_big')/10)*10;
				$peserta->akademik_mtk = (Input::get('akademik_mtk')/10)*10;
				$peserta->akademik_ipa = (Input::get('akademik_ipa')/10)*10;
				$peserta->akademik_ips = (Input::get('akademik_ips')/15)*10;
				$peserta->akademik_avg = $this->hitungRata2Akademik($akademik_pai, $akademik_bin, $akademik_big, $akademik_mtk, $akademik_ipa, $akademik_ips);
				$peserta->bta = Input::get('bta');

				// Siapkan nilai-nilai untuk dihitung
				$nilai = array(
					'raport_pai' => $raport_pai,
					'raport_bin' => $raport_bin,
					'raport_big' => $raport_big,
					'raport_mtk' => $raport_mtk,
					'raport_ipa' => $raport_ipa,
					'raport_ips' => $raport_ips,
					'un_bin' => $un_bin,
					'un_big' => $un_big,
					'un_mtk' => $un_mtk,
					'un_ipa' => $un_ipa,
					'akademik_pai' => $akademik_pai,
					'akademik_bin' => $akademik_bin,
					'akademik_big' => $akademik_big,
					'akademik_mtk' => $akademik_mtk,
					'akademik_ipa' => $akademik_ipa,
					'akademik_ips' => $akademik_ips,
					'bta' => $bta,
				);

				// Hitung nilai dengan Profile Matching
				$hasil_1 = $this->profileMatching($pilihan_1, $nilai);
				$hasil_2 = $this->profileMatching($pilihan_2, $nilai);

				// Nilai-nilai yang akan disimpan
				$peserta->score_raport_1 = $hasil_1['raport']*20;
				$peserta->score_un_1 = $hasil_1['un']*20;
				$peserta->score_umum_1 = $hasil_1['umum']*20;
				$peserta->score_total_1 = $hasil_1['total']*20;
				$peserta->score_raport_2 = $hasil_2['raport']*20;
				$peserta->score_un_2 = $hasil_2['un']*20;
				$peserta->score_umum_2 = $hasil_2['umum']*20;
				$peserta->score_total_2 = $hasil_2['total']*20;
				$peserta->suggestion = $hasil_1['total'] >= $hasil_2['total'] ? $pilihan_1 : $pilihan_2;

				if ($peserta->save())
				{
					return Redirect::action('StudentController@showAll')->withSuccess('Perubahan pada calon PDB #'.$id.' telah disimpan');
				}
				else
				{
					return Redirect::action('StudentController@showAll')->withDanger('Gagal menyimpan perubahan pada calon PDB'.$id);
				}
			}
		}
		else
		{
			return Redirect::action('StudentController@showAll')->withDanger('Maaf, kami tidak dapat menemukan Calon PDB dengan nomor pendaftaran #'.$id);
		}
	}

	/**
	 * Tampilkan halaman tambah data Calon PDB.
	 *
	 * @return void
	 */
	public function addNew()
	{
		$data = array();
		$no = DB::table('students')->select('id')->orderBy('id', 'desc')->first();
		if (is_null($no))
		{
			$data['nomor'] = 1;
		}
		else
		{
			$data['nomor'] = $no->id + 1;
		}
		$data['program'] = array('Tahfidh' => 'Tahfidh', 'Akselerasi' => 'Akselerasi', 'BCA' => 'BCA', 'BCS' => 'BCS', 'Reguler' => 'Reguler');

		$this->layout->title = 'Calon Peserta Didik Baru';
		$this->layout->content = View::make('create', $data);
	}

	/**
	 * Tambahkan data Calon PDB.
	 *
	 * @return void
	 */
	public function storeNew()
	{
		// Validasi masukan
		$data = array('name' => Input::get('name'), 'school_name' => Input::get('school_name'));
		$rules = array('name' => 'required', 'school_name' => 'required');
		$val = Validator::make($data, $rules);

		if ($val->fails())
		{
			return Redirect::action('StudentController@addNew')->withInput()->withErrors($val);
		}
		else
		{
			// Beri nilai awal pada nilai-nilai
			$pilihan_1 = $this->pilihMinat(Input::get('program_1'), Input::get('group_1'));
			$pilihan_2 = $this->pilihMinat(Input::get('program_2'), Input::get('group_2'));
			$raport_pai = is_null(Input::get('raport_pai')) ? 0 : round(Input::get('raport_pai')/10);
			$raport_bin = is_null(Input::get('raport_bin')) ? 0 : round(Input::get('raport_bin')/10);
			$raport_big = is_null(Input::get('raport_big')) ? 0 : round(Input::get('raport_big')/10);
			$raport_mtk = is_null(Input::get('raport_mtk')) ? 0 : round(Input::get('raport_mtk')/10);
			$raport_ipa = is_null(Input::get('raport_ipa')) ? 0 : round(Input::get('raport_ipa')/10);
			$raport_ips = is_null(Input::get('raport_ips')) ? 0 : round(Input::get('raport_ips')/10);
			$un_bin = is_null(Input::get('un_bin')) ? 0 : round(Input::get('un_bin'));
			$un_big = is_null(Input::get('un_big')) ? 0 : round(Input::get('un_big'));
			$un_mtk = is_null(Input::get('un_mtk')) ? 0 : round(Input::get('un_mtk'));
			$un_ipa = is_null(Input::get('un_ipa')) ? 0 : round(Input::get('un_ipa'));

			// Data yang akan disimpan
			$peserta = new $this->student;
			$peserta->name = Input::get('name');
			$peserta->reg_number = $this->hasilkanNoPendaftaran(Input::get('program_1'), Input::get('no_pendaftaran'));
			$peserta->school_name = Input::get('school_name');
			$peserta->program_1 = Input::get('program_1');
			$peserta->group_1 = $pilihan_1;
			$peserta->program_2 = Input::get('program_2');
			$peserta->group_2 = $pilihan_2;
			$peserta->raport_pai = Input::get('raport_pai');
			$peserta->raport_bin = Input::get('raport_bin');
			$peserta->raport_big = Input::get('raport_big');
			$peserta->raport_mtk = Input::get('raport_mtk');
			$peserta->raport_ipa = Input::get('raport_ipa');
			$peserta->raport_ips = Input::get('raport_ips');
			$peserta->raport_ips = Input::get('raport_ips');
			$peserta->avg_raport = $this->hitungRata2Raport($raport_pai, $raport_bin, $raport_big, $raport_mtk, $raport_ipa, $raport_ips);
			$peserta->un_bin = Input::get('un_bin');
			$peserta->un_big = Input::get('un_big');
			$peserta->un_mtk = Input::get('un_mtk');
			$peserta->un_ipa = Input::get('un_ipa');
			$peserta->un_avg = $this->hitungRata2UN(Input::get('un_bin'), Input::get('un_big'), Input::get('un_mtk'), Input::get('un_ipa'));

			// Siapkan nilai-nilai untuk dihitung
			$nilai = array(
				'raport_pai' => $raport_pai,
				'raport_bin' => $raport_bin,
				'raport_big' => $raport_big,
				'raport_mtk' => $raport_mtk,
				'raport_ipa' => $raport_ipa,
				'raport_ips' => $raport_ips,
				'un_bin' => $un_bin,
				'un_big' => $un_big,
				'un_mtk' => $un_mtk,
				'un_ipa' => $un_ipa,
				'akademik_pai' => 0,
				'akademik_bin' => 0,
				'akademik_big' => 0,
				'akademik_mtk' => 0,
				'akademik_ipa' => 0,
				'akademik_ips' => 0,
				'bta' => 0,
			);

			// Hitung nilai dengan Profile Matching
			$hasil_1 = $this->profileMatching($pilihan_1, $nilai);
			$hasil_2 = $this->profileMatching($pilihan_2, $nilai);

			// Nilai-nilai yang akan disimpan
			$peserta->score_raport_1 = $hasil_1['raport']*20;
			$peserta->score_un_1 = $hasil_1['un']*20;
			$peserta->score_umum_1 = $hasil_1['umum']*20;
			$peserta->score_total_1 = $hasil_1['total']*20;
			$peserta->score_raport_2 = $hasil_2['raport']*20;
			$peserta->score_un_2 = $hasil_2['un']*20;
			$peserta->score_umum_2 = $hasil_2['umum']*20;
			$peserta->score_total_2 = $hasil_2['total']*20;
			$peserta->suggestion = $hasil_1['total'] >= $hasil_2['total'] ? $pilihan_1 : $pilihan_2;

			if ($peserta->save())
			{
				return Redirect::action('StudentController@addNew')->withSuccess('Telah menambahkan calon PDB #'.$peserta->id);
			}
			else
			{
				return Redirect::action('StudentController@addNew')->withDanger('Gagal menambahkan calon PDB');
			}
		}
	}

	/**
	 * Hapus data Calon PDB.
	 *
	 * @return void
	 */
	public function deleteStudent($id)
	{
		if ( $student = $this->student->find($id) )
		{
			$student->delete();

			return Redirect::action('StudentController@showAll')->withSuccess('Calon PDB dengan nomor pendaftaran #'.$id.' telah dihapus');
		}
		else
		{
			return Redirect::action('StudentController@showAll')->withDanger('Maaf, kami tidak dapat menemukan Calon PDB dengan nomor pendaftaran #'.$id);
		}
	}

	/**
	 * Ekspor data Calon PDB ke MS Excel sesuai program kelas.
	 *
	 * @param  string $program
	 * @return void
	 */
	public function exportProgramExcel($program = null)
	{
		$peserta = $this->student->select('reg_number', 'name', 'program_1', 'school_name', 'akademik', 'bta', 'avg_raport', 'score_total_1', 'suggestion')->where('program_1', $program)->get()->toArray();

		Excel::create('Daftar Calon PDB 2014-2015',  function($excel) use($peserta, $program) {
			$excel->setTitle('Daftar Calon PDB 2014-2015');
			$excel->setCompany('MAN Nganjuk');

			$excel->sheet($program, function($sheet) use($peserta, $program) {
				$sheet->setOrientation('landscape');
				$sheet->fromArray($peserta, null, 'A1', true, true);
			});
		})->download('xlsx');
	}

	/**
	 * Ekspor data semua Calon PDB ke MS Excel.
	 *
	 * @return void
	 */
	public function exportExcel()
	{
		$peserta = $this->student->all()->toArray();

		Excel::create('Daftar Calon PDB 2014-2015',  function($excel) use($peserta) {
			$excel->setTitle('Daftar Calon PDB 2014-2015');
			$excel->setCompany('MAN Nganjuk');

			$excel->sheet('Daftar Calon PDB', function($sheet) use($peserta) {
				$sheet->setOrientation('landscape');
				$sheet->fromArray($peserta, null, 'A1', true, true);
			});
		})->download('xlsx');
	}

	/**
	 * Otomatis isi minat sesuai program kelas.
	 *
	 * @param  string $program
	 * @param  string $minat
	 * @return string
	 */
	public function pilihMinat($program = null, $minat = null)
	{
		if ( is_null($minat))
		{
			switch ($program) {
				case 'Tahfidh':
					return 'AGAMA';
					break;

				case 'Akselerasi':
					return 'IPA';
					break;
			
				case 'BCA':
					return 'IPA';
					break;

				default:
					return 'IPS';
					break;
			}
		}
		else
		{
			return $minat;
		}
	}

	/**
	 * Ekspor data semua Calon PDB ke MS Excel.
	 *
	 * @param string $nilai
	 * @return int
	 */
	public function hitungIQ($nilai)
	{
		switch ($nilai) {
			case $nilai > 139 and $nilai < 170:
				return 10;
				break;

			case $nilai > 119 and $nilai < 140:
				return 9;
				break;

			case $nilai > 109 and $nilai < 120:
				return 8;
				break;

			case $nilai > 89 and $nilai < 110:
				return 7;
				break;

			case $nilai > 79 and $nilai < 90:
				return 6;
				break;
			
			default:
				return 5;
				break;
		}
	}

	/**
	 * Hitung nilai rata-rata raport.
	 *
	 * @param float $pai
	 * @param float $bin
	 * @param float $big
	 * @param float $mtk
	 * @param float $ipa
	 * @param float $ips
	 * @return float
	 */
	public function hitungRata2Raport($pai, $bin, $big, $mtk, $ipa, $ips)
	{
		return ($pai+$bin+$big+$mtk+$ipa+$ips)/6;
	}

	/**
	 * Hitung nilai rata-rata UN.
	 *
	 * @param float $bin
	 * @param float $big
	 * @param float $mtk
	 * @param float $ipa
	 * @return float
	 */
	public function hitungRata2UN($bin, $big, $mtk, $ipa)
	{
		return ($bin+$big+$mtk+$ipa)/4;
	}

	/**
	 * Hitung nilai rata-rata raport.
	 *
	 * @param float $pai
	 * @param float $bin
	 * @param float $big
	 * @param float $mtk
	 * @param float $ipa
	 * @param float $ips
	 * @return float
	 */
	public function hitungRata2Akademik($pai, $bin, $big, $mtk, $ipa, $ips)
	{
		return ($pai+$bin+$big+$mtk+$ipa+$ips)/6;
	}

	/**
	 * Hasilkan Kode No. Pendaftaran.
	 *
	 * @param string $program
	 * @param int $no_pendaftaran
	 * @return string
	 */
	public function hasilkanNoPendaftaran($program, $no_pendaftaran)
	{
		switch ($program) {
			case 'Tahfidh':
				return '2014-06-PDB/Tahfidh-'.$no_pendaftaran;
				break;

			case 'Akselerasi':
				return '2014-06-PDB/AKSEL-'.$no_pendaftaran;
				break;

			case 'BCA':
				return '2014-06-PDB/BCA-'.$no_pendaftaran;
				break;

			case 'BCS':
				return '2014-06-PDB/BCS-'.$no_pendaftaran;
				break;
			
			default:
				return '2014-06-PDB/REG-'.$no_pendaftaran;
				break;
		}
	}

	/**
	 * Proses Profile Matching.
	 *
	 * @param string $minat
	 * @param array $nilai
	 * @return array
	 */
	public function profileMatching($minat, $nilai)
	{
		// Hitung nilai gap
		$gap = $this->hitungNilaiGap($minat, $nilai);
		// Hitung nilai bobot
		$bobot = $this->hitungNilaiBobot($gap);
		// Hitung nilai tiap kriteria
		$kriteria = $this->hitungKriteria($minat, $bobot);
		// Hitung nilai total
		$total = $this->hitungTotal($kriteria);

		$hasil = array(
			'raport' => $kriteria['raport'],
			'un' => $kriteria['un'],
			'umum' => $kriteria['umum'],
			'total' => $total,
		);

		return $hasil;
	}

	/**
	 * Hitung nilai gap.
	 *
	 * @param string $minat
	 * @param array $nilai
	 * @return array
	 */
	public function hitungNilaiGap($minat, $nilai)
	{
		$gap = array();

		$profil_ideal = DB::table('groups')
			->select('raport_pai', 'raport_bin', 'raport_big', 'raport_mtk', 'raport_ipa', 'raport_ips', 'un_bin', 'un_big', 'un_mtk', 'un_ipa', 'akademik_pai', 'akademik_bin', 'akademik_big', 'akademik_mtk', 'akademik_ipa', 'akademik_ips', 'bta', 'iq')
			->where('name', $minat)
			->first();

		$gap[] = $nilai['raport_pai'] - $profil_ideal->raport_pai;
		$gap[] = $nilai['raport_bin'] - $profil_ideal->raport_bin;
		$gap[] = $nilai['raport_big'] - $profil_ideal->raport_big;
		$gap[] = $nilai['raport_mtk'] - $profil_ideal->raport_mtk;
		$gap[] = $nilai['raport_ipa'] - $profil_ideal->raport_ipa;
		$gap[] = $nilai['raport_ips'] - $profil_ideal->raport_ips;

		$gap[] = $nilai['un_bin'] - $profil_ideal->un_bin;
		$gap[] = $nilai['un_big'] - $profil_ideal->un_big;
		$gap[] = $nilai['un_mtk'] - $profil_ideal->un_mtk;
		$gap[] = $nilai['un_ipa'] - $profil_ideal->un_ipa;

		$gap[] = $nilai['akademik_pai'] - $profil_ideal->akademik_pai;
		$gap[] = $nilai['akademik_bin'] - $profil_ideal->akademik_bin;
		$gap[] = $nilai['akademik_big'] - $profil_ideal->akademik_big;
		$gap[] = $nilai['akademik_mtk'] - $profil_ideal->akademik_mtk;
		$gap[] = $nilai['akademik_ipa'] - $profil_ideal->akademik_ipa;
		$gap[] = $nilai['akademik_ips'] - $profil_ideal->akademik_ips;

		$gap[] = $nilai['bta'] - $profil_ideal->bta;

		return $gap;
	}

	/**
	 * Ubah nilai gap menjadi nilai bobot.
	 *
	 * @param array $nilai
	 * @return array
	 */
	public function hitungNilaiBobot($nilai)
	{
		$bobot = array();

		for ($i=0; $i < 17; $i++)
		{ 
			switch ($nilai[$i]) {
				case 0:
					$bobot[] = 5;
					break;

				case 1:
					$bobot[] = 4.5;
					break;

				case -1:
					$bobot[] = 4;
					break;

				case 2:
					$bobot[] = 3.5;
					break;

				case -2:
					$bobot[] = 3;
					break;

				case 3:
					$bobot[] = 2.5;
					break;

				case -3:
					$bobot[] = 2;
					break;

				case 4:
					$bobot[] = 1.5;
					break;

				case -4:
					$bobot[] = 1;
					break;

				case 5:
					$bobot[] = 0.5;
					break;
				
				default:
					$bobot[] = 0;
					break;
			}
		}

		return $bobot;
	}

	/**
	 * Hitung nilai total tiap kriteria.
	 *
	 * @param string $minat
	 * @param array $nilai
	 * @return array
	 */
	public function hitungKriteria($minat, $nilai)
	{
		$kriteria = array();
		$query = DB::table('settings')->select('core', 'secondary')->where('id', 1)->first();
		$cf = $query->core;
		$sf = $query->secondary;

		switch ($minat) {
			case 'AGAMA':
				$raport_core = array(
					'pai' => $nilai[0],
					'bin' => $nilai[1],
					'big' => $nilai[2],
					'mtk' => $nilai[3],
				);
				$jml_raport_core = count($raport_core);
				$total_raport_core = array_sum($raport_core);
				$ncf_raport = $total_raport_core/$jml_raport_core;

				$raport_secondary = array(
					'ipa' => $nilai[4],
					'ips' => $nilai[5],
				);
				$jml_raport_secondary = count($raport_secondary);
				$total_raport_secondary = array_sum($raport_secondary);
				$nsf_raport = $total_raport_secondary/$jml_raport_secondary;

				$nilai_raport = (($cf/100)*$ncf_raport) + (($sf/100)*$nsf_raport);
				$kriteria['raport'] = $nilai_raport;

				$un_core = array(
					'bin' => $nilai[6],
					'mtk' => $nilai[8],
				);
				$jml_un_core = count($un_core);
				$total_un_core = array_sum($un_core);
				$ncf_un = $total_un_core/$jml_un_core;

				$un_secondary = array(
					'big' => $nilai[7],
					'ipa' => $nilai[9],
				);
				$jml_un_secondary = count($un_secondary);
				$total_un_secondary = array_sum($un_secondary);
				$nsf_un = $total_un_secondary/$jml_un_secondary;

				$nilai_un = (($cf/100)*$ncf_un) + (($sf/100)*$nsf_un);
				$kriteria['un'] = $nilai_un;

				$umum_core = array(
					'pai' => $nilai[10],
					'bin' => $nilai[11],
					'big' => $nilai[12],
					'mtk' => $nilai[13],
					'bta' => $nilai[16],
				);
				$jml_umum_core = count($umum_core);
				$total_umum_core = array_sum($umum_core);
				$ncf_umum = $total_umum_core/$jml_umum_core;

				$umum_secondary = array(
					'ipa' => $nilai[14],
					'ips' => $nilai[15],
				);
				$jml_umum_secondary = count($umum_secondary);
				$total_umum_secondary = array_sum($umum_secondary);
				$nsf_umum = $total_umum_secondary/$jml_umum_secondary;

				$nilai_umum = (($cf/100)*$ncf_umum) + (($sf/100)*$nsf_umum);
				$kriteria['umum'] = $nilai_umum;

				return $kriteria;
				break;

			case 'IPA':
				$raport_core = array(
					'bin' => $nilai[1],
					'big' => $nilai[2],
					'mtk' => $nilai[3],
					'ipa' => $nilai[4],
				);
				$jml_raport_core = count($raport_core);
				$total_raport_core = array_sum($raport_core);
				$ncf_raport = $total_raport_core/$jml_raport_core;

				$raport_secondary = array(
					'pai' => $nilai[0],
					'ips' => $nilai[5],
				);
				$jml_raport_secondary = count($raport_secondary);
				$total_raport_secondary = array_sum($raport_secondary);
				$nsf_raport = $total_raport_secondary/$jml_raport_secondary;

				$nilai_raport = (($cf/100)*$ncf_raport) + (($sf/100)*$nsf_raport);
				$kriteria['raport'] = $nilai_raport;

				$un_core = array(
					'mtk' => $nilai[8],
					'ipa' => $nilai[9],
				);
				$jml_un_core = count($un_core);
				$total_un_core = array_sum($un_core);
				$ncf_un = $total_un_core/$jml_un_core;

				$un_secondary = array(
					'bin' => $nilai[6],
					'big' => $nilai[7],
				);
				$jml_un_secondary = count($un_secondary);
				$total_un_secondary = array_sum($un_secondary);
				$nsf_un = $total_un_secondary/$jml_un_secondary;

				$nilai_un = (($cf/100)*$ncf_un) + (($sf/100)*$nsf_un);
				$kriteria['un'] = $nilai_un;

				$umum_core = array(
					'bin' => $nilai[11],
					'big' => $nilai[12],
					'mtk' => $nilai[13],
					'ipa' => $nilai[14],
					'bta' => $nilai[16],
				);
				$jml_umum_core = count($umum_core);
				$total_umum_core = array_sum($umum_core);
				$ncf_umum = $total_umum_core/$jml_umum_core;

				$umum_secondary = array(
					'pai' => $nilai[10],
					'ips' => $nilai[15],
				);
				$jml_umum_secondary = count($umum_secondary);
				$total_umum_secondary = array_sum($umum_secondary);
				$nsf_umum = $total_umum_secondary/$jml_umum_secondary;

				$nilai_umum = (($cf/100)*$ncf_umum) + (($sf/100)*$nsf_umum);
				$kriteria['umum'] = $nilai_umum;

				return $kriteria;
				break;
			
			default:
				$raport_core = array(
					'bin' => $nilai[1],
					'big' => $nilai[2],
					'mtk' => $nilai[3],
					'ips' => $nilai[5],
				);
				$jml_raport_core = count($raport_core);
				$total_raport_core = array_sum($raport_core);
				$ncf_raport = $total_raport_core/$jml_raport_core;

				$raport_secondary = array(
					'pai' => $nilai[0],
					'ipa' => $nilai[4],
				);
				$jml_raport_secondary = count($raport_secondary);
				$total_raport_secondary = array_sum($raport_secondary);
				$nsf_raport = $total_raport_secondary/$jml_raport_secondary;

				$nilai_raport = (($cf/100)*$ncf_raport) + (($sf/100)*$nsf_raport);
				$kriteria['raport'] = $nilai_raport;

				$un_core = array(
					'bin' => $nilai[6],
					'mtk' => $nilai[8],
				);
				$jml_un_core = count($un_core);
				$total_un_core = array_sum($un_core);
				$ncf_un = $total_un_core/$jml_un_core;

				$un_secondary = array(
					'big' => $nilai[7],
					'ipa' => $nilai[9],
				);
				$jml_un_secondary = count($un_secondary);
				$total_un_secondary = array_sum($un_secondary);
				$nsf_un = $total_un_secondary/$jml_un_secondary;

				$nilai_un = (($cf/100)*$ncf_un) + (($sf/100)*$nsf_un);
				$kriteria['un'] = $nilai_un;

				$umum_core = array(
					'bin' => $nilai[11],
					'big' => $nilai[12],
					'mtk' => $nilai[13],
					'ips' => $nilai[15],
					'bta' => $nilai[16],
				);
				$jml_umum_core = count($umum_core);
				$total_umum_core = array_sum($umum_core);
				$ncf_umum = $total_umum_core/$jml_umum_core;

				$umum_secondary = array(
					'pai' => $nilai[10],
					'ipa' => $nilai[14],
				);
				$jml_umum_secondary = count($umum_secondary);
				$total_umum_secondary = array_sum($umum_secondary);
				$nsf_umum = $total_umum_secondary/$jml_umum_secondary;

				$nilai_umum = (($cf/100)*$ncf_umum) + (($sf/100)*$nsf_umum);
				$kriteria['umum'] = $nilai_umum;

				return $kriteria;
				break;
		}
	}

	/**
	 * Hitung nilai total.
	 *
	 * @param array $kriteria
	 * @return float
	 */
	public function hitungTotal($kriteria)
	{
		$query = DB::table('settings')->select('raport', 'un', 'umum')->where('id', 1)->first();
		$raport = $query->raport;
		$un = $query->un;
		$umum = $query->umum;

		$total = (($raport/100)*$kriteria['raport']) + (($un/100)*$kriteria['un']) + (($umum/100)*$kriteria['umum']);

		return $total; 
	}
}