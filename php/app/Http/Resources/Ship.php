<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Position as PositionResource;
use App\Http\Resources\ShipPosition as ShipPositionResource;
use App\ShipPosition;
use App\Position;

class Ship extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'manufacturer' => $this->manufacturer,
      'name' => $this->name,
      'crewPositions' => new PositionResource(Position::whereIn('id', ShipPosition::where('ship', $this->id)->get()->position)->get())
    ];
  }
}
