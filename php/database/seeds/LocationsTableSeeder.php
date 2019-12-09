<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LocationsTableSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {

    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    DB::table('locations')->delete();
    DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    $locs = [
      'UNKNOWN' => [],
      'Systems' => [
        'Stanton' => ['id' => 1],
      ],

      'Stars' => [
        'Stanton' => ['id' => 1000, 'parent' => 1],
      ],

      'Bodies' => [
        'Crusader' => ['id' => 2000, 'parent' => 1000],
        'Hurston' => ['id' => 0, 'parent' => 1000],
        'ArcCorp' => ['id' => 0, 'parent' => 1000],
        'MicroTech' => ['id' => 0, 'parent' => 1000],
        'Cellin' => ['id' => 0, 'parent' => 'Crusader'],
        'Delamar' => ['id' => 0, 'parent' => 'Crusader'],
        'Yela' => ['id' => 0, 'parent' => 'Crusader'],
        'Daymar' => ['id' => 0, 'parent' => 'Crusader'],
        'Aberdeen' => ['id' => 0, 'parent' => 'Hurston'],
        'Arial' => ['id' => 0, 'parent' => 'Hurston'],
        'Magda' => ['id' => 0, 'parent' => 'Hurston'],
        'Ita' => ['id' => 0, 'parent' => 'Hurston'],
        'Lyria' => ['id' => 0, 'parent' => 'ArcCorp'],
        'Wala' => ['id' => 0, 'parent' => 'ArcCorp'],
      ],

      'LandingZone' => [
        'Port Olisar' => ['id' => 10000, 'parent' => 2000],
        'Comm Array ST2-28' => ['id' => 0, 'parent' => 'Crusader'],
        'Comm Array ST2-47' => ['id' => 0, 'parent' => 'Crusader'],
        'Comm Array ST2-55' => ['id' => 0, 'parent' => 'Crusader'],
        'Comm Array ST2-76' => ['id' => 0, 'parent' => 'Crusader'],
        'Grim Hex' => ['id' => 0, 'parent' => 'Yela'],
        'ArcCorp Mining Area 157' => ['id' => 0, 'parent' => 'Yela'],
        'Aston Ridge Aid Shelter' => ['id' => 0, 'parent' => 'Yela'],
        'Kosso Basin Aid Shelter' => ['id' => 0, 'parent' => 'Yela'],
        'Nakamura Valley Aid Shelter' => ['id' => 0, 'parent' => 'Yela'],
        'Talarine Divide Aid Shelter' => ['id' => 0, 'parent' => 'Yela'],
        'Benson Mining Outpost' => ['id' => 0, 'parent' => 'Yela'],
        'Deakins Research Outpost' => ['id' => 0, 'parent' => 'Yela'],
        'Covalex Shipping Hub Gundo' => ['id' => 0, 'parent' => 'Daymar'],
        'Covalex Shipping Hub Gundo' => ['id' => 0, 'parent' => 'Daymar'],
        'Kudre Ore Mine (Closed)' => ['id' => 0, 'parent' => 'Daymar'],
        'Eager Flats Aid Shelter' => ['id' => 0, 'parent' => 'Daymar'],
        'ArcCorp Mining Area 141' => ['id' => 0, 'parent' => 'Daymar'],
        'Dunlow Ridge Aid Shelter' => ['id' => 0, 'parent' => 'Daymar'],
        'Tamdon Plains Aid Shelter' => ['id' => 0, 'parent' => 'Daymar'],
        'Wolf Point Aid Shelter' => ['id' => 0, 'parent' => 'Daymar'],
        'Bountiful Harvest Hydroponics	' => ['id' => 0, 'parent' => 'Daymar'],
        'Kudre Ore' => ['id' => 0, 'parent' => 'Daymar'],
        'Shubin Mining Facility SCD-1' => ['id' => 0, 'parent' => 'Daymar'],
        'Brio\'s Breaker Yard' => ['id' => 0, 'parent' => 'Daymar'],
        'Nuen Waste Management' => ['id' => 0, 'parent' => 'Daymar'],
        'Security Post Kareah' => ['id' => 0, 'parent' => 'Cellin'],
        'Ashburn Channel Aid Shelter' => ['id' => 0, 'parent' => 'Cellin'],
        'Flanagan\'s Ravine Aid Shelter' => ['id' => 0, 'parent' => 'Cellin'],
        'Julep Ravine Aid Shelter' => ['id' => 0, 'parent' => 'Cellin'],
        'Mogote Aid Shelter' => ['id' => 0, 'parent' => 'Cellin'],
        'Gallete Family Farms' => ['id' => 0, 'parent' => 'Cellin'],
        'Tram & Myers Mining' => ['id' => 0, 'parent' => 'Cellin'],
        'Hickes Research Outpost' => ['id' => 0, 'parent' => 'Cellin'],
        'Terra Mills HydroFarm' => ['id' => 0, 'parent' => 'Cellin'],
        'PRIVATE PROPERTY' => ['id' => 0, 'parent' => 'Cellin'],
        'Levski' => ['id' => 0, 'parent' => 'Delamar'],
        'HDMO-Calthrope (NA)' => ['id' => 0, 'parent' => 'Hurston'],
        'Comm Array ST1-61' => ['id' => 0, 'parent' => 'Hurston'],
        'Comm Array ST1-13' => ['id' => 0, 'parent' => 'Hurston'],
        'Comm Array ST1-92' => ['id' => 0, 'parent' => 'Hurston'],
        'Comm Array ST1-48' => ['id' => 0, 'parent' => 'Hurston'],
        'Lorville' => ['id' => 0, 'parent' => 'Hurston'],
        'HDMS-Edmond' => ['id' => 0, 'parent' => 'Hurston'],
        'HDMS-Hadley' => ['id' => 0, 'parent' => 'Hurston'],
        'HDMS-Oparei' => ['id' => 0, 'parent' => 'Hurston'],
        'HDMS-Pinewood' => ['id' => 0, 'parent' => 'Hurston'],
        'HDMS-Stanhope' => ['id' => 0, 'parent' => 'Hurston'],
        'HDMS-Thedus' => ['id' => 0, 'parent' => 'Hurston'],
        'HDSF-Adlai' => ['id' => 0, 'parent' => 'Hurston'],
        'HDSF-Barnabas' => ['id' => 0, 'parent' => 'Hurston'],
        'HDSF-Breckinridge	' => ['id' => 0, 'parent' => 'Hurston'],
        'HDSF-Colfax' => ['id' => 0, 'parent' => 'Hurston'],
        'HDSF-Damaris' => ['id' => 0, 'parent' => 'Hurston'],
        'HDSF-Elbridge' => ['id' => 0, 'parent' => 'Hurston'],
        'HDSF-Hendricks' => ['id' => 0, 'parent' => 'Hurston'],
        'HDSF-Hiram' => ['id' => 0, 'parent' => 'Hurston'],
        'HDSF-Hobart' => ['id' => 0, 'parent' => 'Hurston'],
        'HDSF-Ishmael' => ['id' => 0, 'parent' => 'Hurston'],
        'HDSF-Millerand' => ['id' => 0, 'parent' => 'Hurston'],
        'HDSF-Rufus' => ['id' => 0, 'parent' => 'Hurston'],
        'HDSF-Sherman' => ['id' => 0, 'parent' => 'Hurston'],
        'HDSF-Tamar' => ['id' => 0, 'parent' => 'Hurston'],
        'HDSF-Tompkins' => ['id' => 0, 'parent' => 'Hurston'],
        'HDSF-Zacharias' => ['id' => 0, 'parent' => 'Hurston'],
        'Security Depot Hurston-1' => ['id' => 0, 'parent' => 'Hurston'],
        'Reclamation & Disposal Orinth' => ['id' => 0, 'parent' => 'Hurston'],
        'HDMS-Ryder' => ['id' => 0, 'parent' => 'Ita'],
        'HDMS-Woodruff' => ['id' => 0, 'parent' => 'Ita'],
        'HDMO-Dobbs (NA)' => ['id' => 0, 'parent' => 'Aberdeen'],
        'HDMS-Anderson' => ['id' => 0, 'parent' => 'Aberdeen'],
        'HDMS-Norgaard' => ['id' => 0, 'parent' => 'Aberdeen'],
        'HDMS-Bezdek' => ['id' => 0, 'parent' => 'Arial'],
        'HDMS-Lathan' => ['id' => 0, 'parent' => 'Arial'],
        'HDMS-Hahn' => ['id' => 0, 'parent' => 'Magda'],
        'HDMS-Perlman' => ['id' => 0, 'parent' => 'Magda'],
        'Area18' => ['id' => 0, 'parent' => 'ArcCorp'],
        'Area04' => ['id' => 0, 'parent' => 'ArcCorp'],
        'Area06	' => ['id' => 0, 'parent' => 'ArcCorp'],
        'Area11' => ['id' => 0, 'parent' => 'ArcCorp'],
        'Area17' => ['id' => 0, 'parent' => 'ArcCorp'],
        'Area20' => ['id' => 0, 'parent' => 'ArcCorp'],
        'Comm Array ST3-90' => ['id' => 0, 'parent' => 'ArcCorp'],
        'Comm Array ST3-18' => ['id' => 0, 'parent' => 'ArcCorp'],
        'Comm Array ST3-35' => ['id' => 0, 'parent' => 'ArcCorp'],
        'Comm Array ST3-02' => ['id' => 0, 'parent' => 'ArcCorp'],
        'Humboldt Mines' => ['id' => 0, 'parent' => 'Lyria'],
        'Loveridge Mineral Reserve' => ['id' => 0, 'parent' => 'Lyria'],
        'Shubin Mining Facility SAL-2' => ['id' => 0, 'parent' => 'Lyria'],
        'Shubin Mining Facility SAL-5' => ['id' => 0, 'parent' => 'Lyria'],
        'Security Depot Lyria-1' => ['id' => 0, 'parent' => 'Lyria'],
        'Shubin Processing Facility SPAL-12' => ['id' => 0, 'parent' => 'Lyria'],
        'Shubin Processing Facility SPAL-3' => ['id' => 0, 'parent' => 'Lyria'],
        'Shubin Processing Facility SPAL-7' => ['id' => 0, 'parent' => 'Lyria'],
        'Shubin Processing Facility SPAL-9' => ['id' => 0, 'parent' => 'Lyria'],
        '"The Pit"' => ['id' => 0, 'parent' => 'Lyria'],
        '"Wheeler\'s"' => ['id' => 0, 'parent' => 'Lyria'],
        'The Orphanage' => ['id' => 0, 'parent' => 'Lyria'],
        'Paradise Cove' => ['id' => 0, 'parent' => 'Lyria'],
        'ArcCorp Mining Area 045' => ['id' => 0, 'parent' => 'Wala'],
        'ArcCorp Mining Area 048' => ['id' => 0, 'parent' => 'Wala'],
        'ArcCorp Mining Area 056' => ['id' => 0, 'parent' => 'Wala'],
        'ArcCorp Mining Area 061' => ['id' => 0, 'parent' => 'Wala'],
        'Samson & Son\'s Salvage Center' => ['id' => 0, 'parent' => 'Wala'],
        'ArcCorp Mining Area 061' => ['id' => 0, 'parent' => 'Stanton'],
        'R&R ARC-L1' => ['id' => 0, 'parent' => 'Stanton'],
        'R&R ARC-L2' => ['id' => 0, 'parent' => 'Stanton'],
        'R&R ARC-L3' => ['id' => 0, 'parent' => 'Stanton'],
        'R&R ARC-L4' => ['id' => 0, 'parent' => 'Stanton'],
        'R&R ARC-L5' => ['id' => 0, 'parent' => 'Stanton'],
        'R&R CRU-L1' => ['id' => 0, 'parent' => 'Stanton'],
        'R&R CRU-L4' => ['id' => 0, 'parent' => 'Stanton'],
        'R&R CRU-L5' => ['id' => 0, 'parent' => 'Stanton'],
        'R&R HUR-L1' => ['id' => 0, 'parent' => 'Stanton'],
        'R&R HUR-L2' => ['id' => 0, 'parent' => 'Stanton'],
        'R&R HUR-L3' => ['id' => 0, 'parent' => 'Stanton'],
        'R&R HUR-L4' => ['id' => 0, 'parent' => 'Stanton'],
        'R&R HUR-L5' => ['id' => 0, 'parent' => 'Stanton'],
      ]

    ];

    $lastId = 0;
    $typeIndexNum = 0;

    foreach ($locs as $typeIndex => $typeLocations) {

      foreach ($typeLocations as $locationIndex => $location) {

        //echo array_keys($locs)[$typeIndexNum] . "\n";
        //echo $locationIndex . "\n";
        //Explicit ID not set, increment from previous.
        if ($location['id'] === 0) {
          $location['id'] = $lastId + 1;
        }

        //Parent given was a string reference, not an id
        if (isset($location['parent']) && !is_numeric($location['parent'])) {
          //Search higher up in the hierarchy for a parent to grab its id
          if (isset($locs[array_keys($locs)[$typeIndexNum - 2]]) && isset($locs[array_keys($locs)[$typeIndexNum - 2]][$location['parent']]))
            $location['parent'] = $locs[array_keys($locs)[$typeIndexNum - 2]][$location['parent']]['id'];
          else if (isset($locs[array_keys($locs)[$typeIndexNum - 1]]) && isset($locs[array_keys($locs)[$typeIndexNum - 1]][$location['parent']]))
            $location['parent'] = $locs[array_keys($locs)[$typeIndexNum - 1]][$location['parent']]['id'];
          //if parent is the same type of Object as child(Planets -> Moons, both are Bodies)
          else if ($locs[$typeIndex] && $locs[$typeIndex][$location['parent']])
            $location['parent'] = $locs[$typeIndex][$location['parent']]['id'];
        }

        \App\Location::insert([
          'id' => $location['id'],
          'type' => $typeIndexNum,
          'name' => $locationIndex,
          'parent' => isset($location['parent']) ? $location['parent'] : null,
        ]);


        $lastId = $location['id'];

        $locs[$typeIndex][$locationIndex] = $location;
      }
      $typeIndexNum++;
    }
  }
}
