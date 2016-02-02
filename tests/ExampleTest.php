<?php

use Laracasts\Integrated\Extensions\Goutte as IntegrationTest;

class ExampleTest extends IntegrationTest {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	protected $baseUrl = 'http://client.local';

	public function testBasicExample()
	{
//		$response = $this->call('GET', '/');
//		$this->assertEquals(200, $response->getStatusCode());
		//session(['email' => 'celius55@yahoo.com', 'password' => '123123']);
//		$this -> visit('/')
//			-> type('celius55@yahoo.com', 'email')
//			-> type('123123', 'password')
//			-> press('Войти')
//			-> see('Улица');
		for ($i=0; $i<11; $i++) {
			$this->visit('create')
				->type('Союз Церквей ХВЕ'.$i, 'title')
				->type('3', 'members')
				->type('2', 'children')
				->type('Дмитрий Иванов'.$i, 'destinatar')
				->type('ул. Мирча чел Бэтрын', 'street')
				->type('4'.$i, 'number')
				->type('5'.$i, 'apartment')
				->type('3602'.$i, 'index')
				->type('Кишинев', 'village')
				->type('Кишинев', 'rayon')
				->type('022 349 695', 'phone')
				->type('info@admin.com', 'email')
				->type('www.page.com', 'webpage')
				->type('other information as text', 'other')
				//Servant
				->type('Евгений Роман Паскару'.$i, 'servant_name')
				->type('2015-11-01', 'servant_register')
				->type('Олга Петровна', 'servant_register_name')
				->type('022 123 456', 'servant_phone')
				->type('069 654 321', 'servant_mobile')
				->type('olga@mail.ru', 'servant_email')
				->type('ул. Stefan cel Mare', 'servant_street')
				->type('3'.$i, 'servant_number')
				->type('5'.$i, 'servant_apartment')
				->type('3600', 'servant_index')
				->type('Ialoveni', 'servant_village')
				->type('Chisinau', 'servant_rayon')
				->type('other information as plain text', 'servant_other')
				->press('Отправить данные');
		}
	}

}
