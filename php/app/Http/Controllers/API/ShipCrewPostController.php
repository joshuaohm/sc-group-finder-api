<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\ShipCrewPost;
use App\Ship;
use App\User;
use Validator;
use App\Http\Resources\ShipCrewPost as ShipCrewPostResource;

class ShipCrewPostController extends BaseController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $scPosts = ShipCrewPost::where('is_active', true)->get();

    return $this->sendResponse(ShipCrewPostResource::collection($scPosts), 'Ship Crew Posts retrieved successfully.');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $input = $request->all();

    $validator = Validator::make($input, [
      'description' => 'required',
      'ship_id' => 'required|numeric|min:1',
      'members' => 'required'
    ]);

    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }

    $user = auth()->guard('api')->user();

    if (!$user || !$user->id) {
      return $this->sendError('Validation Error.', "Poster information was missing.");
    }

    $postedMembers = json_decode($input['members']);
    $postedShip = Ship::where('id', htmlspecialchars($input['ship_id']))->first();
    $shipPositions = json_decode($postedShip->crewPositions, true);

    if (!$postedMembers || !$postedShip || !$shipPositions) {
      return $this->sendError('Validation Error.', "Ship information was missing.");
    }

    //Disable crewPositions or set creator to position
    foreach ($shipPositions as $index => $crewPosition) {

      $crewPosObj = json_decode($crewPosition);

      if ($postedMembers[$index]->member === "this") {
        $crewPosObj->member = $user->id;
        $crewPosObj->enabled = true;
      } else if ($postedMembers[$index]->member === "none") {
        $crewPosObj->member = 0;
        $crewPosObj->enabled = false;
      }

      $shipPositions[$index] = $crewPosObj;
    }


    $scPost = ShipCrewPost::create($input);

    $scPost->creator_id = $user->id;
    $scPost->members = json_encode($shipPositions, true);
    $scPost->save();

    return $this->sendResponse(new ShipCrewPostResource($scPost), 'Ship Crew Post created successfully.');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $scPost = ShipCrewPost::find($id);

    if (is_null($scPost)) {
      return $this->sendError('Ship Crew Post not found.');
    }

    return $this->sendResponse(new ShipCrewPostResource($scPost), 'Ship Crew Post retrieved successfully.');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, ShipCrewPost $scPost)
  {
    $input = $request->all();

    $validator = Validator::make($input, [
      'description' => 'required',
      'ship' => 'required'
    ]);

    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }

    $scPost->description = $input['description'];
    $scPost->ship = $input['ship'];
    $scPost->save();

    return $this->sendResponse(new ShipCrewPostResource($scPost), 'Ship Crew Post updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(ShipCrewPost $scPost)
  {
    $scPost->isActive = false;
    $scPost->save();

    return $this->sendResponse([], 'Ship Crew Post deleted successfully.');
  }
}
