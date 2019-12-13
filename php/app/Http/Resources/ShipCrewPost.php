<?php

namespace App\Http\Resources;

use App\Http\Middleware\TrustProxies;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Ship;
use App\Location;
use App\User;
use App\ShipCrewPosition;
use App\Http\Resources\Ship as ShipResource;
use App\Http\Resources\Location as LocationResource;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\ShipCrewPosition as ShipCrewPositionResource;


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

    $total = $members::count() + $miscCrew::count();
    $filled = $members::where('filled', true)->count() + $miscCrew::where('filled', true)->count();

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
    $members = new ShipCrewPositionResource(ShipCrewPosition::where('post', $this->id)->where('type', '!=', 1)->get());
    $miscCrew = new ShipCrewPositionResource(ShipCrewPosition::where('post', $this->id)->where('type', 1)->get());

    return [
      'id' => $this->id,
      'description' => $this->description,
      'ship' => new ShipResource(Ship::where('id', $this->ship_id)->first()),
      'members' => $members,
      'miscCrew' => $miscCrew,
      'creator' =>  User::where('id', $this->creator_id)->first(),
      'gameMode' => $this->parseGameMode($this->gameMode),
      'startLocation' => new LocationResource(Location::where('id', $this->startLocation)->first()),
      'targetLocation' => new LocationResource(Location::where('id', $this->targetLocation)->first()),
      'slotsAvailable' => $this->calculateAvailableSlots($members, $miscCrew),
      'created_at' => $this->created_at->format('d/m/Y'),
      'updated_at' => $this->updated_at->format('d/m/Y'),
    ];
  }
}
