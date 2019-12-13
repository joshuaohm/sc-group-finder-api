<?php

use Illuminate\Database\Seeder;
use App\Ship;
use App\Position;
use App\ShipPosition;

class ShipsTableSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {

    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    DB::table('ships')->delete();
    DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    $temp = 0;

    $ships = [
      'Aegis' => [
        'Avenger Stalker' => ['type' => 'pilot'],
        'Avenger Titan' => ['type' => 'pilot'],
        'Avenger Warlock' => ['type' => 'pilot'],
        'Eclipse' => ['type' => 'pilot'],
        'Gladius' => [
          ['type' => 'pilot'],
          ['type' => 'turret', 'location' => 'top']
        ],
        'Hammerhead' => [
          ['type' => 'pilot'],
          ['type' => 'co-pilot'],
          ['type' => 'turret', 'location' => 'frontLeft'],
          ['type' => 'turret', 'location' => 'frontRight'],
          ['type' => 'turret', 'location' => 'backLeft'],
          ['type' => 'turret', 'location' => 'backRight'],
          ['type' => 'turret', 'location' => 'top'],
          ['type' => 'turret', 'location' => 'bottom'],
        ]
      ],
      'Drake' => [
        'Buccaneer' => [
          ['type' => 'pilot']
        ],
        'Cutlass Black' => [
          ['type' => 'pilot'],
          ['type' => 'co-pilot'],
          ['type' => 'turret', 'location' => 'top']
        ]
      ]
    ];

    foreach ($ships as $manuIndex => $manufacturer) {
      foreach ($manufacturer as $shipIndex => $ship) {

        $temp = \App\Ship::insertGetId([
          'manufacturer' => $manuIndex,
          'name' => $shipIndex
        ]);

        foreach ($ship as $positionIndex => $position) {
          \App\ShipPosition::insert([
            'ship' => $temp,
            'position' => Position::where('type', $position['type'])->where('location', $position['location'])->first()->id
          ]);
        }
      }
    }
  }
}
