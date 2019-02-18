<?php
declare( strict_types = 1 );

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateThreadsTable
 */
class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->string('title')
                  ->unique();
            $table->string('content')
                  ->nullable();

	        $table->foreign('user_id')
	              ->references('id')
	              ->on('users')
	              ->onDelete('cascade');

            $table->timestamps();
        });

	    Schema::table('threads', function (Blueprint $table) {
		    $table->foreign('user_id')
		          ->references('id')
		          ->on('users')
		          ->onDelete('cascade');

		    $table->timestamps();
	    });

	    DB::statement("COMMENT ON TABLE threads IS 'Users threads'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('threads');
    }
}
