<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipCrewPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_crew_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_active');
            $table->bigInteger('creator_id')->unsigned();
            $table->string('invite_code', 6)->unique();
            $table->string('description', 255);
            $table->bigInteger('ship_id')->unsigned();
            $table->json('miscCrew')->nullable();
            $table->json('members');
            $table->timestamps();
        });

        Schema::table('ship_crew_posts', function($table) {
            $table->foreign('creator_id')->references('id')->on('users');
	    $table->foreign('ship_id')->references('id')->on('ships');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ship_crew_posts');
    }
}
