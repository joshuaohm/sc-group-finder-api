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
    $shipPositions =  ShipPosition::where('ship', $this->id)->get()->position;
    return [
      'manufacturer' => $this->manufacturer,
      'name' => $this->name,
      'crewPositions' => new PositionResource::collection(Position::whereIn('id', $shipPositions)->get())
    ];
  }
}
