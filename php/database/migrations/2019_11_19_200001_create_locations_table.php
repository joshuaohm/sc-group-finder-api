<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('locations', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer('parent')->unsigned()->nullable()->after('id');
      $table->string('name');
      $table->integer('type')->default(0);
      $table->timestamps();
    });

    Schema::table('locations', function ($table) {
      $table->foreign('parent')->references('id')->on('locations');
    });
  }

  /**
   * Reverse the migratio ns.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('locations');
  }
}
