<?php

use Illuminate\Database\Seeder;
use App\Ship;

class ShipsTableSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {

    \App\Ship::insert([
      'manufacturer' => 'Aegis',
      'name' => 'Avenger Stalker',
      'crewPositions' => json_encode(array(
        json_encode(array("type" => "pilot"), JSON_UNESCAPED_SLASHES)
      )),
    ]);

    \App\Ship::insert([
      'manufacturer' => 'Aegis',
      'name' => 'Avenger Titan',
      'crewPositions' => json_encode(array(
        json_encode(array("type" => "pilot"), JSON_UNESCAPED_SLASHES)
      )),
    ]);

    \App\Ship::insert([
      'manufacturer' => 'Aegis',
      'name' => 'Avenger Warlock',
      'crewPositions' => json_encode(array(
        json_encode(array("type" => "pilot"), JSON_UNESCAPED_SLASHES)
      )),
    ]);

    \App\Ship::insert([
      'manufacturer' => 'Aegis',
      'name' => 'Eclipse',
      'crewPositions' => json_encode(array(
        json_encode(array("type" => "pilot"), JSON_UNESCAPED_SLASHES)
      )),
    ]);

    \App\Ship::insert([
      'manufacturer' => 'Aegis',
      'name' => 'Gladius',
      'crewPositions' => json_encode(array(
        json_encode(array("type" => "pilot"), JSON_UNESCAPED_SLASHES)
      )),
    ]);

    \App\Ship::insert([
      'manufacturer' => 'Aegis',
      'name' => 'Hammerhead',
      'crewPositions' => json_encode(array(
        json_encode(array("type" => "pilot"), JSON_UNESCAPED_SLASHES),
        json_encode(array("type" => "co-pilot"), JSON_UNESCAPED_SLASHES),
        json_encode(array("type" => "turret", "position" => "frontLeft"), JSON_UNESCAPED_SLASHES),
        json_encode(array("type" => "turret", "position" => "frontRight"), JSON_UNESCAPED_SLASHES),
        json_encode(array("type" => "turret", "position" => "backLeft"), JSON_UNESCAPED_SLASHES),
        json_encode(array("type" => "turret", "position" => "backRight"), JSON_UNESCAPED_SLASHES),
        json_encode(array("type" => "turret", "position" => "top"), JSON_UNESCAPED_SLASHES),
        json_encode(array("type" => "turret", "position" => "bottom"), JSON_UNESCAPED_SLASHES)
      )),
    ]);
  }
}
