<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('reg_number');
			$table->string('school_name');
			$table->enum('program_1', array('Tahfidh', 'Akselerasi', 'BCA', 'BCS', 'Reguler'));
			$table->enum('group_1', array('AGAMA', 'IPA', 'IPS'));
			$table->enum('program_2', array('Tahfidh', 'Akselerasi', 'BCA', 'BCS', 'Reguler'));
			$table->enum('group_2', array('AGAMA', 'IPA', 'IPS'));
			$table->decimal('raport_pai', 5,2)->nullable();
			$table->decimal('raport_bin', 5,2)->nullable();
			$table->decimal('raport_big', 5,2)->nullable();
			$table->decimal('raport_mtk', 5,2)->nullable();
			$table->decimal('raport_ipa', 5,2)->nullable();
			$table->decimal('raport_ips', 5,2)->nullable();
			$table->decimal('avg_raport', 5,2)->nullable();
			$table->decimal('un_bin', 4,2)->nullable();
			$table->decimal('un_big', 4,2)->nullable();
			$table->decimal('un_mtk', 4,2)->nullable();
			$table->decimal('un_ipa', 4,2)->nullable();
			$table->integer('akademik')->unsigned()->nullable();
			$table->integer('bta')->unsigned()->nullable();
			$table->integer('iq')->unsigned()->nullable();
			$table->decimal('score_raport_1', 5,2)->nullable();
			$table->decimal('score_un_1', 5,2)->nullable();
			$table->decimal('score_umum_1', 5,2)->nullable();
			$table->decimal('score_total_1', 5,2)->nullable();
			$table->decimal('score_raport_2', 5,2)->nullable();
			$table->decimal('score_un_2', 5,2)->nullable();
			$table->decimal('score_umum_2', 5,2)->nullable();
			$table->decimal('score_total_2', 5,2)->nullable();
			$table->enum('suggestion', array('AGAMA', 'IPA', 'IPS'));
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('students');
	}

}
