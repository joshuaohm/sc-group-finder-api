<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipPositionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('ship_positions', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('ship')->unsigned();
      $table->bigInteger('position')->unsigned();
      $table->timestamps();
    });

    Schema::table('ship_positions', function ($table) {
      $table->foreign('ship')->references('id')->on('ships');
      $table->foreign('position')->references('id')->on('positions');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('ship_positions');
  }
}
