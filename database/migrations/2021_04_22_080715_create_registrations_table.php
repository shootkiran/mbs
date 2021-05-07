<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registrations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 99);
			$table->date('dobad');
			$table->integer('level');
			$table->integer('reg_number');
			$table->timestamps(10);
			$table->integer('payment_id')->nullable();
			$table->integer('payment_received')->default(0);
			$table->integer('examination_id')->nullable();
			$table->integer('collection_id')->nullable();
			$table->integer('user_id')->nullable();
			$table->integer('admission_number')->nullable();
			$table->integer('dummy')->nullable()->default(0);
			$table->integer('contact')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registrations');
	}

}
