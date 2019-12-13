<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Ship;
use App\ShipCrewPost;
use App\User;
use App\ShipPosition
use App\Http\Resources\Ship as ShipResource;
use App\Http\Resources\ShipCrewPost as ShipCrewPostResource;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\ShipPosition as ShipPositionResource;

class ShipCrewPosition extends JsonResource
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
      'type' => new ShipPositionResource(ShipPosition::where('id', $this->type)->first()),
      'ship' => new ShipResource(Ship::where('id', $this->ship)->first()->id),
      'post' => new ShipCrewPostResource(ShipCrewPost::where('id', $this->post)->first()->id),
      'user' => new UserResource(User::where('id', $this->user)->first()),
      'requested' => $this->requested,
      'filled' => $this->filled,
      'created_at' => $this->created_at->format('d/m/Y'),
      'updated_at' => $this->updated_at->format('d/m/Y'),
    ];
  }
}
