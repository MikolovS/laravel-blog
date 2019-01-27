<?php
declare( strict_types = 1 );

use Illuminate\Database\Seeder;

/**
 * Class ThreadSeeder
 */
class ThreadSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run ()
	{
		factory(\App\Models\Thread::class, 'with_author', 10)->create();
	}
}
