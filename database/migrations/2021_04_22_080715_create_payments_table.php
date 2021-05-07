<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('voucher_number');
			$table->binary('verified', 1);
			$table->integer('user_registration_id');
			$table->timestamps(10);
			$table->text('bank_branch');
			$table->dateTime('deposit_date');
			$table->text('deposit_by');
			$table->integer('photo_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payments');
	}

}
