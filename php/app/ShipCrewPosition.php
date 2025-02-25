<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipCrewPosition extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    "type", "post", "user", "filled", "requested"
  ];
}
