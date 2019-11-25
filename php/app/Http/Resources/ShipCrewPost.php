<?php

namespace App\Http\Resources;

use App\Http\Middleware\TrustProxies;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Ship;
use App\Http\Resources\Ship as ShipResource;

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

      if (isset($position['member']) && $position['member'] > 0)
        $filled++;
    }
    foreach (json_decode($miscCrew, true) as $position) {
      if (isset($position['member']) && $position['member'] > 0)
        $filled++;

      $total++;
    }
    return $filled . "/" . $total;
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
      'slotsAvailable' => $this->calculateAvailableSlots($this->members, $this->miscCrew),
      'created_at' => $this->created_at->format('d/m/Y'),
      'updated_at' => $this->updated_at->format('d/m/Y'),
    ];
  }
}
