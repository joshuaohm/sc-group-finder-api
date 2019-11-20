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
          json_encode( array( "type" => "pilot"))
        )),
      ]);

      \App\Ship::insert([
        'manufacturer' => 'Aegis',
        'name' => 'Avenger Titan',
        'crewPositions' => json_encode(array(
          json_encode( array( "type" => "pilot"))
        )),
      ]);

      \App\Ship::insert([
        'manufacturer' => 'Aegis',
        'name' => 'Avenger Warlock',
        'crewPositions' => json_encode(array(
          json_encode( array( "type" => "pilot"))
        )),
      ]);

      \App\Ship::insert([
        'manufacturer' => 'Aegis',
        'name' => 'Eclipse',
        'crewPositions' => json_encode(array(
          json_encode( array( "type" => "pilot"))
        )),
      ]);

      \App\Ship::insert([
        'manufacturer' => 'Aegis',
        'name' => 'Gladius',
        'crewPositions' => json_encode(array(
          json_encode( array( "type" => "pilot"))
        )),
      ]);

      \App\Ship::insert([
        'manufacturer' => 'Aegis',
        'name' => 'Hammerhead',
        'crewPositions' => json_encode(array(
          json_encode( array( "type" => "pilot")),
          json_encode( array( "type" => "co-pilot")),
          json_encode( array( "type" => "turret"), array("position" => "frontLeft")),
          json_encode( array( "type" => "turret"), array("position" => "frontRight")),
          json_encode( array( "type" => "turret"), array("position" => "backLeft")),
          json_encode( array( "type" => "turret"), array("position" => "backRight")),
          json_encode( array( "type" => "turret"), array("position" => "top")),
          json_encode( array( "type" => "turret"), array("position" => "bottom"))
        )),
      ]);
    }
}
