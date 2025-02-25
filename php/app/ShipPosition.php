<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipPosition extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    "ship", "position",
  ];
}
