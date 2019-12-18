<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Ship;
use App\ShipCrewPost;
use App\User;
use App\ShipPosition;
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
      'position' => $this->position,
      'ship' => $this->ship,
      'post' => $this->post,
      'user' => new UserResource(User::where('id', $this->user)->first()),
      'requested' => $this->requested,
      'filled' => $this->filled
    ];
  }
}
