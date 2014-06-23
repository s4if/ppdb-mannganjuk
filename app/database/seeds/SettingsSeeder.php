<?php

class SettingsSeeder extends Seeder
{
	public function run()
	{
		DB::table('settings')->insert(array(
			'core' => 80,
			'secondary' => 20,
			'raport' => 20,
			'un' => 20,
			'umum' => 60,
		));

		DB::table('groups')->insert(array(
			'name' => 'AGAMA',
			'raport_pai' => 10,
			'raport_bin' => 10,
			'raport_big' => 10,
			'raport_mtk' => 10,
			'raport_ipa' => 8,
			'raport_ips' => 8,
			'un_bin' => 10,
			'un_big' => 7,
			'un_mtk' => 10,
			'un_ipa' => 7,
			'akademik' => 10,
			'bta' => 10,
			'iq' => 10,
		));

		DB::table('groups')->insert(array(
			'name' => 'IPA',
			'raport_pai' => 8,
			'raport_bin' => 10,
			'raport_big' => 10,
			'raport_mtk' => 10,
			'raport_ipa' => 10,
			'raport_ips' => 8,
			'un_bin' => 7,
			'un_big' => 7,
			'un_mtk' => 10,
			'un_ipa' => 10,
			'akademik' => 10,
			'bta' => 10,
			'iq' => 10,
		));

		DB::table('groups')->insert(array(
			'name' => 'IPS',
			'raport_pai' => 7,
			'raport_bin' => 10,
			'raport_big' => 10,
			'raport_mtk' => 10,
			'raport_ipa' => 8,
			'raport_ips' => 10,
			'un_bin' => 10,
			'un_big' => 7,
			'un_mtk' => 10,
			'un_ipa' => 7,
			'akademik' => 10,
			'bta' => 10,
			'iq' => 10,
		));
	}
}