<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\ShipCrewPost;
use App\Ship;
use App\User;
use App\ShipCrewPosition;
use App\ShipPosition;
use App\Position;
use App\Http\Resources\ShipCrewPost as ShipCrewPostResource;
use App\Http\Resources\ShipCrewPosition as ShipCrewPositionResource;
use App\Http\Resources\ShipPosition as ShipPositionResource;

class ShipCrewPostController extends BaseController
{

  //Iterates through Positions and posted ShipCrewPositions and creates actual ShipCrewPositions
  private function createPositions($postedMembers, $ship, $post)
  {
    try {

      $shipCrewPositions = collect();

      foreach ($postedMembers as $positionIndex => $position) {

        if ($position['enabled']) {

          $newPosition = null;

          $newPosition = ShipCrewPosition::create([
            'post' => $post,
            'user' => $position['user'] && $position['user']['id'] ? $position['user']['id'] : null,
            'requested' => false,
            'filled' => $position['user'] && $position['user']['id'] && $position['user']['id'] > 0 ? true : false,
          ]);

          $newPosition->ship = $ship;
          $newPosition->position = htmlspecialchars($position['id']);
          $newPosition->save();
        }
        if ($newPosition)
          $shipCrewPositions->push($newPosition);
        else {
          return false;
        }
      }
      return $shipCrewPositions;
    } catch (Exception $e) {
      return false;
    }
  }

  private function createMiscCrewPositions($miscCrew, $ship, $post)
  {
    $temp = collect();

    if (isset($miscCrew) && is_numeric($miscCrew) && isset($ship) && isset($post)) {
      for ($i = 0; $i < $miscCrew; $i++) {

        $newPosition = ShipCrewPosition::create([
          'post' => $post,
          'user' => null,
          'requested' => false,
          'filled' => false,
        ]);

        $newPosition->ship = $ship;
        $newPosition->position = 1;
        $newPosition->save();

        $temp->push($newPosition);
      }
    } else return false;

    return $temp;
  }

  private function validatePositions($scPositions, $positions)
  {

    if ($scPositions->count() !== $positions->count())
      return false;

    $scPositions = $scPositions->sortBy('type');
    $positions = $positions->sortBy('type');

    for ($i = 0; $i < $scPositions->count(); $i++) {

      if ($scPositions[$i]->type !== $scPositions[$i]->type) {
        return false;
        break;
      }

      if ((isset($scPositions[$i]->location) && isset($positions[$i]->location)) && $scPositions[$i]->location !== $positions[$i]->location) {
        return false;
        break;
      }

      $scPositions[$i]->position = $positions[$i]->id;
    }

    return true;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    /* User Validation */

    $user = auth()->guard('api')->user();

    if (!$user || !$user->id) {
      return $this->sendError('Validation Error.', "Poster information was missing.");
    }

    $scPosts = ShipCrewPost::where('isActive', true)->where('creator_id', '!=', $user->id)->get();

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

    /* Input Validation */
    $validator = Validator::make($input, [
      'description' => 'required',
      'ship_id' => 'required|numeric|min:1',
      'members' => 'required',
      'startBody' => 'required',
      'miscCrew' => 'required|numeric'
    ]);

    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }


    /* User Validation */
    $user = auth()->guard('api')->user();

    if (!$user || !$user->id || !$user->name) {
      return $this->sendError('Validation Error.', "Poster information was missing.");
    }


    /* Parse Locations */
    $startLocation = 0;
    $targetLocation = 0;

    if (isset($input['startZone'])) {
      $startLocation = htmlspecialchars($input['startZone']);
    } else if (isset($input['startBody'])) {
      $startLocation = htmlspecialchars($input['startBody']);
    }
    if (isset($input['targetZone'])) {
      $targetLocation = htmlspecialchars($input['targetZone']);
    } else if (isset($input['targetBody'])) {
      $targetLocation = htmlspecialchars($input['targetBody']);
    }

    /* Create Ship Crew Positions */

    $postedMembers = json_decode($input['members'], true);
    $shipPositions =  ShipPosition::select('position')->where('ship', htmlspecialchars($input['ship_id']))->get();
    $positions = Position::whereIn('id', $shipPositions)->get();

    $scPost = ShipCrewPost::create([
      'description' => htmlspecialchars($input['description']),
      'ship_id'     => htmlspecialchars($input['ship_id']),
      'creator_id'  => $user->id,
      'startLocation' => $startLocation > 0 ? $startLocation : null,
      'targetLocation' => $targetLocation > 0 ? $targetLocation : null,
    ]);

    $shipCrewPositions = $this->createPositions($postedMembers, $scPost->ship_id, $scPost->id);
    $miscCrew = isset($input['miscCrew']) ? $this->createMiscCrewPositions($input['miscCrew'], $scPost->ship_id, $scPost->id) : null;

    if (!$miscCrew) {
      return $this->sendError('Validation Error.', "Misc Crew information was missing.");
    }

    if ($shipCrewPositions) {
      return $this->sendResponse(new ShipCrewPostResource($scPost), 'Ship Crew Post created successfully.');
    } else {
      return $this->sendError('Validation Error.', "Crew Position information was invalid.");
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $scPost = ShipCrewPost::where('id', htmlspecialchars($id))->first();

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
      'post_id' => 'required',
      'members' => 'required',
      'miscCrew' => 'required'
    ]);

    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }

    $scPost = ShipCrewPost::where('id', htmlspecialchars($input['post_id']))->first();

    $scPost->description = $input['description'];
    $scPost->members = json_decode($input['members'], true);
    $scPost->miscCrew = json_decode($input['miscCrew'], true);
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

  public function getUsersPosts($id)
  {

    /* User Validation */
    $user = auth()->guard('api')->user();

    if (!$user || !$user->id || !$user->name || ($user->id != $id)) {
      return $this->sendError('Validation Error.', "User information was missing. " . $id . " " . $user->id);
    }

    $scPosts = ShipCrewPost::where('isActive', true)->where('creator_id', $user->id)->get();

    return $this->sendResponse(ShipCrewPostResource::collection($scPosts), 'Ship Crew Posts retrieved successfully.');
  }

  public function requestPosition(Request $request)
  {
    $input = $request->all();

    /* Input Validation */
    $validator = Validator::make($input['position'], [
      'post' => 'required',
      'position' => 'required',
      'user' => 'required',
    ]);

    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }


    /* User Validation */
    $user = auth()->guard('api')->user();

    if (!$user || !$user->id || !$user->name) {
      return $this->sendError('Validation Error.', "Poster information was missing.");
    }

    $currentPositions = json_decode(ShipCrewPost::where('id', htmlspecialchars($input['post_id']))->first()->members, true);
  }
}
