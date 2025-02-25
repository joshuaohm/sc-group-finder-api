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
      $table->boolean('isActive')->default(true);
      $table->bigInteger('creator_id')->unsigned()->default(0);
      $table->bigInteger('ship_id')->unsigned()->default(0);
      $table->string('inviteCode', 6)->unique()->nullable();
      $table->string('description', 255);
      $table->bigInteger('startLocation')->unsigned()->nullable();
      $table->bigInteger('targetLocation')->unsigned()->nullable();
      $table->bigInteger('gameMode')->unsigned()->default(0);
      $table->timestamps();
    });

    Schema::table('ship_crew_posts', function ($table) {
      $table->foreign('creator_id')->references('id')->on('users');
      $table->foreign('ship_id')->references('id')->on('ships');
      $table->foreign('startLocation')->references('id')->on('locations');
      $table->foreign('targetLocation')->references('id')->on('locations');
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
