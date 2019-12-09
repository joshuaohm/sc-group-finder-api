<?php

namespace App\Http\Controllers\API;

use App\Location;
use App\Http\Resources\Location as LocationResource;

class LocationController extends BaseController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $ret = Location::all();

    return $this->sendResponse(LocationResource::collection($ret), 'Locations retrieved successfully.');
  }

  public function showChildren($id)
  {
    $ret = Location::where('parent', $id)->get();

    if (is_null($ret)) {
      return $this->sendError('Ship not found.');
    }

    return $this->sendResponse(new LocationResource($ret), 'Location retrieved successfully.');
  }

  public function showType($type)
  {

    $ret = Location::where('type', $type)->get();

    if (is_null($ret)) {
      return $this->sendError('Ship not found.');
    }

    return $this->sendResponse(new LocationResource($ret), 'Location retrieved successfully.');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $ret = Location::find($id);

    if (is_null($ret)) {
      return $this->sendError('Ship not found.');
    }

    return $this->sendResponse(new LocationResource($ret), 'Location retrieved successfully.');
  }
}
