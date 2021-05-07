<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRegistrationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_registrations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 99);
			$table->date('dobad');
			$table->integer('photo_id')->nullable();
			$table->integer('payment_id')->nullable();
			$table->integer('citizenship_id')->nullable();
			$table->integer('passport_id')->nullable();
			$table->integer('examination_id')->nullable();
			$table->integer('level')->nullable();
			$table->timestamps(10);
			$table->integer('user_id');
			$table->text('contact')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_registrations');
	}

}
