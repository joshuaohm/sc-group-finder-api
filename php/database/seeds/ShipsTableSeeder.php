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

    DB::statement("SET FOREIGN_KEY_CHECKS = 0");
    DB::table("ships")->delete();
    DB::statement("SET FOREIGN_KEY_CHECKS = 1");

    $temp = 0;

    $ships = [
      "Aegis" => [
        "Avenger Stalker" => ["name" => "pilot"],
        "Avenger Titan" => ["name" => "pilot"],
        "Avenger Warlock" => ["name" => "pilot"],
        "Eclipse" => ["name" => "pilot"],
        "Gladius" => [
          ["name" => "pilot"],
          ["name" => "turret", "location" => "top"]
        ],
        "Hammerhead" => [
          ["name" => "pilot"],
          ["name" => "co-pilot"],
          ["name" => "turret", "location" => "frontLeft"],
          ["name" => "turret", "location" => "frontRight"],
          ["name" => "turret", "location" => "backLeft"],
          ["name" => "turret", "location" => "backRight"],
          ["name" => "turret", "location" => "top"],
          ["name" => "turret", "location" => "bottom"],
        ]
      ],
      "Drake" => [
        "Buccaneer" => [
          ["name" => "pilot"]
        ],
        "Cutlass Black" => [
          ["name" => "pilot"],
          ["name" => "co-pilot"],
          ["name" => "turret", "location" => "top"]
        ]
      ]
    ];

    foreach ($ships as $manuIndex => $manufacturer) {
      foreach ($manufacturer as $shipIndex => $ship) {

        $temp = \App\Ship::insertGetId([
          "manufacturer" => $manuIndex,
          "name" => $shipIndex
        ]);

        foreach ($ship as $positionIndex => $position) {
          \App\ShipPosition::insert([
            "ship" => $temp,
            "position" => Position::where("name", $ship["name"])->where("location", isset($ship["location"]) ? $ship['location'] : null)->first()->id
          ]);
        }
      }
    }
  }
}
