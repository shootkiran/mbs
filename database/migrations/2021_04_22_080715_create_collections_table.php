<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('collections', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->dateTime('datetime');
			$table->string('name', 71);
			$table->string('contact', 99)->nullable();
			$table->integer('secondary_contact')->nullable();
			$table->integer('level5')->nullable();
			$table->integer('level4')->nullable();
			$table->integer('level3')->nullable();
			$table->integer('level2')->nullable();
			$table->integer('level1')->nullable();
			$table->integer('students_count');
			$table->integer('amount_received');
			$table->integer('examination_id')->nullable();
			$table->timestamps(10);
			$table->integer('collected_by');
			$table->integer('regd')->nullable()->default(0);
			$table->integer('collection_id');
			$table->integer('refunded')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('collections');
	}

}
