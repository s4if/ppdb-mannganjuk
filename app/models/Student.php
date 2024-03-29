<?php

class Student extends Eloquent
{
	protected $fillable = array(
		'name',
		'reg_number',
		'school_name',
		'program_1',
		'group_1',
		'program_2',
		'group_2',
		'raport_pai',
		'raport_bin',
		'raport_big',
		'raport_mtk',
		'raport_ipa',
		'raport_ips',
		'avg_raport',
		'un_bin',
		'un_big',
		'un_mtk',
		'un_ipa',
		'tes_pai',
		'tes_bin',
		'tes_big',
		'tes_mtk',
		'tes_ipa',
		'tes_ips',
		'akademik_pai',
		'akademik_bin',
		'akademik_big',
		'akademik_mtk',
		'akademik_ipa',
		'akademik_ips',
		'akademik_avg',
		'bta',
		'iq',
		'score_raport_1',
		'score_un_1',
		'score_umum_1',
		'score_total_1',
		'score_raport_2',
		'score_un_2',
		'score_umum_2',
		'score_total_2',
		'suggestion',
	);

	protected $hidden = array(
		'created_at',
		'updated_at',
	);	
}