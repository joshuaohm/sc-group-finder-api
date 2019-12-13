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
    $ret = Location::orderBy('name', 'asc')->get();

    return $this->sendResponse(LocationResource::collection($ret), 'Locations retrieved successfully.');
  }

  public function showChildren($id)
  {
    $ret = Location::where('parent', $id)->orderBy('name', 'asc')->get();

    if (is_null($ret)) {
      return $this->sendError('Location not found.');
    }

    return $this->sendResponse(LocationResource::collection($ret), 'Location retrieved successfully.');
  }

  public function showChildrenOfType($id, $type)
  {
    $ret = Location::where('parent', $id)->where('type', $type)->orderBy('name', 'asc')->get();

    if (is_null($ret)) {
      return $this->sendError('Location not found.');
    }

    return $this->sendResponse(LocationResource::collection($ret), 'Location retrieved successfully.');
  }


  public function showType($type)
  {

    $ret = Location::where('type', $type)->orderBy('name', 'asc')->get();

    if (is_null($ret)) {
      return $this->sendError('Location not found.');
    }

    return $this->sendResponse(LocationResource::collection($ret), 'Location retrieved successfully.');
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
      return $this->sendError('Location not found.');
    }

    return $this->sendResponse(LocationResource::collection($ret), 'Location retrieved successfully.');
  }
}
