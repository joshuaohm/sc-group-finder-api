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
      'crewPositions' => json_encode(['type' => 'pilot']),
    ]);

    \App\Ship::insert([
      'manufacturer' => 'Aegis',
      'name' => 'Avenger Titan',
      'crewPositions' => json_encode(['type' => 'pilot']),
    ]);

    \App\Ship::insert([
      'manufacturer' => 'Aegis',
      'name' => 'Avenger Warlock',
      'crewPositions' => json_encode(['type' => 'pilot']),
    ]);

    \App\Ship::insert([
      'manufacturer' => 'Aegis',
      'name' => 'Eclipse',
      'crewPositions' => json_encode(['type' => 'pilot']),
    ]);

    \App\Ship::insert([
      'manufacturer' => 'Aegis',
      'name' => 'Gladius',
      'crewPositions' => json_encode(['type' => 'pilot']),
    ]);

    \App\Ship::insert([
      'manufacturer' => 'Aegis',
      'name' => 'Hammerhead',
      'crewPositions' => json_encode([
        ['type' => 'pilot'],
        ['type' => 'co-pilot'],
        ['type' => 'turret', 'position' => 'frontLeft'],
        ['type' => 'turret', 'position' => 'frontRight'],
        ['type' => 'turret', 'position' => 'backLeft'],
        ['type' => 'turret', 'position' => 'backRight'],
        ['type' => 'turret', 'position' => 'top'],
        ['type' => 'turret', 'position' => 'bottom'],
      ]),
    ]);
  }
}
