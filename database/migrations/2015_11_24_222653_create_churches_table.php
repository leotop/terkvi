<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChurchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('churches', function(Blueprint $table){
			$table->increments('id');
			$table->integer('key');
			$table->string('title');
			$table->string('region');
			$table->integer('members');
			$table->integer('children');
			$table->string('destinatar');
			$table->string('street');
			$table->string('number');
			$table->string('apartment');
			$table->string('index');
			$table->string('village');
			$table->string('rayon');
			$table->string('phone');
			$table->string('email');
			$table->string('webpage');
			$table->text('information');

			$table->string('servant_name');
			$table->string('servant_post');
			$table->string('servant_register');
			$table->string('servant_register_name');
			$table->string('servant_phone');
			$table->string('servant_mobile');
			$table->string('servant_email');
			$table->string('servant_street');
			$table->string('servant_number');
			$table->string('servant_apartment');
			$table->string('servant_index');
			$table->string('servant_village');
			$table->string('servant_rayon');
			$table->text('servant_other');
			$table->string('country', 20)->default('Молдова');
			$table->integer('servant_post_status')->default(0);
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
		Schema::drop('churches');
	}

}
