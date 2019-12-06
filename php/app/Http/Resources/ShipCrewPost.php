<?php

namespace App\Http\Resources;

use App\Http\Middleware\TrustProxies;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Ship;
use App\Http\Resources\Ship as ShipResource;
use App\User;

class ShipCrewPost extends JsonResource
{
  /*
    * Returns a string to indicate how many crewPositions are available in the post.
    *
    */
  private function calculateAvailableSlots($members, $miscCrew)
  {
    $total = 0;
    $filled = 0;

    foreach (json_decode($members, true) as $position) {

      if (isset($position['enabled']) && $position['enabled'])
        $total++;

      if (isset($position['member']) && $position['member']['id'] > 0)
        $filled++;
    }
    if (isset($miscCrew) && json_decode($miscCrew, true))
      foreach (json_decode($miscCrew, true) as $position) {
        if (isset($position['member']) && $position['member']['id'] > 0)
          $filled++;

        $total++;
      }
    return $filled . "/" . $total;
  }

  /*
   *  Will be used temporarily, remove when gameModes are modeled somewhere (maybe an enum)
   */
  private function parseGameMode($mode)
  {
    switch ($mode) {

      case 1: {
          return 'PU';
          break;
        }
      case 2: {
          return 'Arena Commander';
          break;
        }
      case 3: {
          return 'Star Marine';
          break;
        }
      case 4: {
          return 'Theaters of War';
          break;
        }
    }
  }

  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'description' => $this->description,
      'ship' => new ShipResource(Ship::where('id', $this->ship_id)->first()),
      'members' => json_decode($this->members),
      'miscCrew' => json_decode($this->miscCrew),
      'creator' =>  User::where('id', $this->creator_id)->first()->name,
      'gameMode' => parseGameMode($this->gameMode),
      'startLocation' => $this->startLocation,
      'targetLocation' => $this->targetLocation,
      'slotsAvailable' => $this->calculateAvailableSlots($this->members, $this->miscCrew),
      'created_at' => $this->created_at->format('d/m/Y'),
      'updated_at' => $this->updated_at->format('d/m/Y'),
    ];
  }
}
