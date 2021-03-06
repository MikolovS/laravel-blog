<?php
declare( strict_types = 1 );

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateReplaysTable
 */
class CreateRepliesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up ()
	{
		Schema::create('replies', function (Blueprint $table) {
			$table->increments('id');

			$table->integer('thread_id')->unsigned();
			$table->integer('user_id')->unsigned();

			$table->string('content')
			      ->nullable();

			$table->timestamps();
		});

		Schema::table('replies', function (Blueprint $table) {
			$table->foreign('user_id')
			      ->references('id')
			      ->on('users')
			      ->onDelete('cascade');
			$table->foreign('thread_id')
			      ->references('id')
			      ->on('threads')
			      ->onDelete('cascade');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down ()
	{
		Schema::dropIfExists('replies');
	}
}
