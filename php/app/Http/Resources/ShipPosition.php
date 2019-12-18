<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Position as PositionResource;
use App\Http\Resources\Ship as ShipResource;
use App\Ship;
use App\Position;

class ShipPosition extends JsonResource
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
      'id' => $this->id,
      'position' => new PositionResource(Position::where('id', $this->position)->first()),
      'ship' => new ShipResource(Ship::where('id', $this->ship)->first()),
    ];
  }
}
