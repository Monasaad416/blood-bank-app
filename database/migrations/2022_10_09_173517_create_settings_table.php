<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->text('notification_setting_text')->nullable();
			$table->text('about_app')->nullable();
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
			$table->string('fb_url')->nullable();
			$table->string('tw_url')->nullable();
			$table->string('insta_url')->nullable();
			$table->string('whatsapp_url')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
