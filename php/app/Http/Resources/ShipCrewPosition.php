<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Position;
use App\Http\Resources\Position as PositionResource;

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
      'position' => new PositionResource(Position::where('id', $this->position)->first()),
      'ship' => $this->ship,
      'post' => $this->post,
      'user' => new UserResource(User::where('id', $this->user)->first()),
      'requested' => $this->requested,
      'filled' => $this->filled
    ];
  }
}
