<?php

namespace App\Http\Controllers\API;

use App\Ship;
use App\Http\Resources\Ship as ShipResource;
use Illuminate\Support\Facades\DB;

class ShipController extends BaseController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $ships = Ship::all();

    return $this->sendResponse(ShipResource::collection($ships), 'Ships retrieved successfully.');
  }

  public function getAllManufacturers()
  {
    $manus = Ship::select('manufacturer')->distinct()->get();

    return $this->sendResponse(ShipResource::collection($manus), 'Manufacturers retrieved successfully.');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $ship = Ship::find($id);

    if (is_null($ship)) {
      return $this->sendError('Ship not found.');
    }

    return $this->sendResponse(new ShipResource($ship), 'Ship retrieved successfully.');
  }
}
