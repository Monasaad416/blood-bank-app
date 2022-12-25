<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->date('date_of_birth');
			$table->integer('blood_type_id')->unsigned();
			$table->integer('city_id')->unsigned();
			$table->date('last_donation_date')->nullable();
			$table->string('phone');
			$table->string('password');
			$table->mediumInteger('pin_code')->nullable();
            $table->string('api_token',64)->nullable();
            $table->boolean('is_active')->nullable();

            $table->timestamp('email_verified_at')->nullable();

            $table->rememberToken();

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
