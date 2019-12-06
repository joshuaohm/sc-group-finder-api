<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipCrewPost extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'description', 'ship_id', 'creator_id', 'members', 'miscCrew', 'gameMode', 'startLocation', 'targetLocation'
  ];
}
