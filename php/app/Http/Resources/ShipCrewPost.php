<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Ship;
use App\Http\Resources\Ship as ShipResource;

class ShipCrewPost extends JsonResource
{
  /*
    * Returns a string to indicate how many crewPositions are available in the post.
    *
    */
  public function calculateAvailableSlots($members, $miscCrew)
  {
    $total = 0;
    $filled = 0;

    foreach ($members as $key => $position) {

      if ($position->enabled)
        $total++;

      if ($position->member > 0)
        $filled++;
    }
    foreach ($miscCrew as $key => $position) {
      if ($position->member > 0)
        $filled++;

      $total++;
    }
    return $filled . ":" . $total;
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
      'ship' => new ShipResource(Ship::where('id', $this->ship_id)->get()),
      'members' => $this->members,
      'miscCrew' => $this->miscCrew,
      'slotsAvailable' => calculateAvailableSlots($this->members, $this->miscCrew),
      'created_at' => $this->created_at->format('d/m/Y'),
      'updated_at' => $this->updated_at->format('d/m/Y'),
    ];
  }
}
