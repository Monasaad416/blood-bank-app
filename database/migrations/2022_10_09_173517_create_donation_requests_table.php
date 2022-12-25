<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->string('patient_name');
			$table->smallInteger('patient_age');
			$table->integer('blood_type_id')->unsigned();
			$table->smallInteger('bags_num');
			$table->string('hospital_name');
            $table->string('hospital_address');
			$table->decimal('lattitude', 10,8);
			$table->decimal('longitude', 10,8);
			$table->integer('city_id')->unsigned();
			$table->string('patient_phone');
			$table->text('notes')->nullable();
			$table->integer('client_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}
