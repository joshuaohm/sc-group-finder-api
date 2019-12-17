<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipCrewPositionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('ship_crew_positions', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('position')->unsigned()->nullable();
      $table->bigInteger('post')->unsigned()->nullable();
      $table->bigInteger('ship')->unsigned()->nullable();
      $table->bigInteger('user')->unsigned()->nullable();
      $table->boolean('requested')->default(false);
      $table->boolean('filled')->default(false);
      $table->timestamps();
    });

    Schema::table('ship_crew_positions', function ($table) {
      $table->foreign('post')->references('id')->on('ship_crew_posts');
      $table->foreign('ship')->references('id')->on('ships');
      $table->foreign('position')->references('id')->on('positions');
      $table->foreign('user')->references('id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('ship_crew_positions');
  }
}
