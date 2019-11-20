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
        'crewPositions' => 
        "
          {
            seats: [
              {
                type: 'pilot'
              }
            ]
          }
        ",
      ]);

      \App\Ship::insert([
        'manufacturer' => 'Aegis',
        'name' => 'Avenger Titan',
        'crewPositions' => json_decode(
          "[
            {
              type: 'pilot'
            }
          ]"
        , true),
      ]);

      \App\Ship::insert([
        'manufacturer' => 'Aegis',
        'name' => 'Avenger Warlock',
        'crewPositions' => json_decode(
          "[
            {
              type: 'pilot'
            }
          ]"
        , true),
      ]);

      \App\Ship::insert([
        'manufacturer' => 'Aegis',
        'name' => 'Eclipse',
        'crewPositions' => json_decode(
          "[
            {
              type: 'pilot'
            }
          ]"
        , true),
      ]);

      \App\Ship::insert([
        'manufacturer' => 'Aegis',
        'name' => 'Gladius',
        'crewPositions' => json_decode(
          "[
            {
              type: 'pilot'
            }
          ]"
        , true),
      ]);

      \App\Ship::insert([
        'manufacturer' => 'Aegis',
        'name' => 'Hammerhead',
        'crewPositions' => json_decode(
          "[
            {
              type: 'pilot'
            },
            {
              type: 'co-pilot'
            },
            {
              type: 'pilot'
            },
            {
              type: 'turret',
              position: 'FrontLeft',
            },
            {
              type: 'turret',
              position: 'FrontRight',
            },
            {
              type: 'turret',
              position: 'BackLeft',
            },
            {
              type: 'turret',
              position: 'BackRight',
            },
            {
              type: 'turret',
              position: 'Top',
            },
            {
              type: 'turret',
              position: 'Bottom',
            }
          ]"
        , true),
      ]);
    }
}
