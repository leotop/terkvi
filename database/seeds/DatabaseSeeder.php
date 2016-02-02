<?php

use Illuminate\Contracts\Database;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
//		Model::unguard();
		DB::table('churches')->delete();
		DB::update('alter table churches auto_increment = 1');
		// $this->call('UserTableSeeder');s

		DB::table('churches')->insert([
			'title' => 'Союз Церквей ХВЕ',
			'region' => 'Центральный',
			'members' => '3',
			'children' => '2',
			'destinatar' => 'Дмитрий Иванов',
			'street' => 'ул. Мирча чел Бэтрын',
			'number' => '4',
			'apartment' => '5',
			'index' => 'MD-3602',
			'village' => 'Calarasi',
			'rayon' => 'Кишинев',
			'phone' => '022 349 695',
			'email' => 'info@admin.com',
			'webpage' => 'www.page.com',
			'information' => 'other information as text',
			//servant
			'servant_name' => 'Евгений Роман Паскару',
			'servant_post' => 'Пастор',
			'servant_register' => '2015-11-01',
			'servant_register_name' => 'Олга Петровна',
			'servant_phone' => '022 123 456',
			'servant_mobile' => '069 654 321',
			'servant_email' => 'olga@mail.ru',
			'servant_street' => 'ул. Stefan cel Mare',
			'servant_number' => '3',
			'servant_apartment' => '5',
			'servant_index' => '3600',
			'servant_village' => 'Ialoveni',
			'servant_rayon' => 'Calarasi',
			'servant_other' => 'other information as plain text',
			'servant_post_status' => 1,
		]);
		DB::table('churches')->insert([
			'title' => 'Союз Церквей ХВЕ2',
			'region' => 'Центральный',
			'members' => '3',
			'children' => '2',
			'destinatar' => 'Дмитрий Иванов',
			'street' => 'ул. Мирча чел Бэтрын',
			'number' => '5',
			'apartment' => '6',
			'index' => 'MD-3603',
			'village' => 'Balti',
			'rayon' => 'Кишинев',
			'phone' => '022 349 695',
			'email' => 'info@admin.com',
			'webpage' => 'www.page.com',
			'information' => 'other information as text',
			//servant
			'servant_name' => 'Евгений Роман Паскару2',
			'servant_post' => 'Пастор',
			'servant_register' => '2015-11-01',
			'servant_register_name' => 'Олга Петровна',
			'servant_phone' => '022 123 456',
			'servant_mobile' => '069 654 321',
			'servant_email' => 'olga@mail.ru',
			'servant_street' => 'ул. Stefan cel Mare',
			'servant_number' => '3',
			'servant_apartment' => '5',
			'servant_index' => '3600',
			'servant_village' => 'Ialoveni',
			'servant_rayon' => 'Chisinau',
			'servant_other' => 'other information as plain text',
			'servant_post_status' => 1,
		]);
		DB::table('churches')->insert([
			'title' => 'Союз Церквей ХВЕ3',
			'region' => 'Центральный',
			'members' => '3',
			'children' => '2',
			'destinatar' => 'Дмитрий Иванов',
			'street' => 'ул. Мирча чел Бэтрын',
			'number' => '6',
			'apartment' => '7',
			'index' => 'MD-3603',
			'village' => 'Ungheni',
			'rayon' => 'Кишинев',
			'phone' => '022 349 695',
			'email' => 'info@admin.com',
			'webpage' => 'www.page.com',
			'information' => 'other information as text',
			//servant
			'servant_name' => 'Евгений Роман Паскару3',
			'servant_post' => 'Пастор',
			'servant_register' => '2015-11-01',
			'servant_register_name' => 'Олга Петровна',
			'servant_phone' => '022 123 456',
			'servant_mobile' => '069 654 321',
			'servant_email' => 'olga@mail.ru',
			'servant_street' => 'ул. Stefan cel Mare',
			'servant_number' => '3',
			'servant_apartment' => '5',
			'servant_index' => '3600',
			'servant_village' => 'Ialoveni',
			'servant_rayon' => 'Chisinau',
			'servant_other' => 'other information as plain text',
			'servant_post_status' => 1,
		]);
		DB::table('churches')->insert([
			'title' => 'Союз Церквей ХВЕ4',
			'region' => 'Центральный',
			'members' => '3',
			'children' => '2',
			'destinatar' => 'Дмитрий Иванов',
			'street' => 'ул. Мирча чел Бэтрын',
			'number' => '7',
			'apartment' => '8',
			'index' => 'MD-3603',
			'village' => 'Chisinau',
			'rayon' => 'Кишинев',
			'phone' => '022 349 695',
			'email' => 'info@admin.com',
			'webpage' => 'www.page.com',
			'information' => 'other information as text',
			//servant
			'servant_name' => 'Евгений Роман Паскару4',
			'servant_post' => 'Пастор',
			'servant_register' => '2015-11-01',
			'servant_register_name' => 'Олга Петровна',
			'servant_phone' => '022 123 456',
			'servant_mobile' => '069 654 321',
			'servant_email' => 'olga@mail.ru',
			'servant_street' => 'ул. Stefan cel Mare',
			'servant_number' => '3',
			'servant_apartment' => '5',
			'servant_index' => '3600',
			'servant_village' => 'Ialoveni',
			'servant_rayon' => 'Chisinau',
			'servant_other' => 'other information as plain text',
		]);
		DB::table('churches')->insert([
			'title' => 'Союз Церквей ХВЕ5',
			'region' => 'Центральный',
			'members' => '4',
			'children' => '3',
			'destinatar' => 'Дмитрий Иванов',
			'street' => 'ул. Мирча чел Бэтрын',
			'number' => '7',
			'apartment' => '8',
			'index' => 'MD-3603',
			'village' => 'Soroca',
			'rayon' => 'Кишинев',
			'phone' => '022 349 695',
			'email' => 'info@admin.com',
			'webpage' => 'www.page.com',
			'information' => 'other information as text',
			//servant
			'servant_name' => 'Евгений Роман Паскару5',
			'servant_post' => 'Пастор',
			'servant_register' => '2015-11-01',
			'servant_register_name' => 'Олга Петровна',
			'servant_phone' => '022 123 456',
			'servant_mobile' => '069 654 321',
			'servant_email' => 'olga@mail.ru',
			'servant_street' => 'ул. Stefan cel Mare',
			'servant_number' => '3',
			'servant_apartment' => '5',
			'servant_index' => '3600',
			'servant_village' => 'Ialoveni',
			'servant_rayon' => 'Chisinau',
			'servant_other' => 'other information as plain text',
		]);

	}

}
