<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('name', array('AGAMA', 'IPA', 'IPS'));
			$table->integer('raport_pai');
			$table->integer('raport_bin');
			$table->integer('raport_big');
			$table->integer('raport_mtk');
			$table->integer('raport_ipa');
			$table->integer('raport_ips');
			$table->integer('un_bin');
			$table->integer('un_big');
			$table->integer('un_mtk');
			$table->integer('un_ipa');
			$table->integer('akademik');
			$table->integer('bta');
			$table->integer('iq');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('groups');
	}

}
