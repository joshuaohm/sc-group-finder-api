<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    "type", "location",
  ];
}
