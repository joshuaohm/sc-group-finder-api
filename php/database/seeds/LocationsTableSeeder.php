<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {

    $ids = [
      'Crusader' => 1,
      'Hurston' => 2,
      'ArcCorp' => 3,
      'MicroTech' => 4,
      'Cellin' => 5,
      'Yela' => 6,
      'Daymar' => 7,
      'Aberdeen' => 8,
      'Arial' => 9,
      'Magda' => 10,
      'Lyria' => 11,
      'Wala' => 12,
    ];

    /* Bodies */

    /* Crusader */

    \App\Location::insert([
      'id' => $ids['Crusader'],
      'type' => 3,
      'name' => 'Crusader',
    ]);

    \App\Location::insert([
      'type' => 3,
      'name' => 'Yela',
      'parent' => $ids['Crusader'],
    ]);

    \App\Location::insert([
      'type' => 3,
      'name' => 'Daymar',
      'parent' => $ids['Crusader'],
    ]);

    \App\Location::insert([
      'type' => 3,
      'name' => 'Cellin',
      'parent' => $ids['Crusader'],
    ]);

    /* Hurston */

    \App\Location::insert([
      'id' => $ids['Hurston'],
      'type' => 3,
      'name' => 'Hurston',
    ]);

    \App\Location::insert([
      'type' => 3,
      'name' => 'Aberdeen',
      'parent' => $ids['Hurston'],
    ]);

    \App\Location::insert([
      'type' => 3,
      'name' => 'Arial',
      'parent' => $ids['Hurston'],
    ]);

    \App\Location::insert([
      'type' => 3,
      'name' => 'Magda',
      'parent' => $ids['Hurston'],
    ]);

    /* ArcCorp */

    \App\Location::insert([
      'id' => $ids['ArcCorp'],
      'type' => 3,
      'name' => 'ArcCorp',
    ]);

    \App\Location::insert([
      'type' => 3,
      'name' => 'Lyria',
      'parent' => $ids['ArcCorp'],
    ]);

    \App\Location::insert([
      'type' => 3,
      'name' => 'Wala',
      'parent' => $ids['ArcCorp'],
    ]);

    /* MicroTech */

    \App\Location::insert([
      'id' => $ids['MicroTech'],
      'type' => 3,
      'name' => 'MicroTech',
    ]);



    /* SubLocations (Landing Zones For Now) */

    \App\Location::insert([
      'id' => 10000,
      'type' => 4,
      'name' => 'Port Olisar',
      'parent' => $ids['Crusader'],
    ]);

    \App\Location::insert([
      'type' => 4,
      'name' => 'GrimHex',
      'parent' => $ids['Yela'],
    ]);

    \App\Location::insert([
      'type' => 4,
      'name' => 'Lorville',
      'parent' => $ids['Hurston'],
    ]);

    \App\Location::insert([
      'type' => 4,
      'name' => 'Area 18',
      'parent' => $ids['ArcCorp'],
    ]);
  }
}
