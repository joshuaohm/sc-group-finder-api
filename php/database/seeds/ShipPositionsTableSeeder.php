<?php

use Illuminate\Database\Seeder;
use App\ShipPosition;

class ShipPositionsTableSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {

    //Make sure misc is first, it needs id === 1
    $types = ['misc', 'pilot', 'co-pilot', 'turret', 'support'];

    $positions = ['', 'front', 'rear', 'left', 'right', 'top', 'bottom', 'frontLeft', 'frontRight', 'rearLeft', 'rearRight'];

    $miscFlag = true;
    foreach ($types as $index => $type) {

      foreach ($positions as $index2 => $position) {

        //Misc slots have no position, and values of '' should be null
        if (($type === 'misc' && $miscFlag) || $position === '') {
          $position = null;
        }

        //Only add 1 misc slot, every variation for other types
        if (($type === 'misc' && $miscFlag)
          || $type != 'misc'
        ) {
          \App\ShipPosition::insert([
            'type' => $type,
            'position' => $position
          ]);
        }

        if ($type === 'misc')
          $miscFlag = false;
      }
    }
  }
}
