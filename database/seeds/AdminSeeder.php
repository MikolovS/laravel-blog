<?php
declare( strict_types = 1 );

use Illuminate\Database\Seeder;

/**
 * Class AdminSeeder
 */
class AdminSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run ()
	{
		\App\Models\Admin::create([
			'email'    => 'admin@mail.ru',
			'password' => Hash::make('123456'),
		]);
	}
}
