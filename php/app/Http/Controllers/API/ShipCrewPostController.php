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

  //Iterates through crewPositions on a ship and creates assignable members slots for the post
  private function createPositions($template, $requested, $userId, $userName)
  {
    //Disable crewPositions or set creator to position
    if (count($template, COUNT_RECURSIVE) == 1 && count($requested, COUNT_RECURSIVE) == 1) {

      $template[0]->enabled = true;

      //Assign position to creator, or disable it
      if (isset($requested[0]['member']) && $requested[0]['member']['id'] === "this") {
        $template[0]['member']['id'] = $userId;
        $template[0]['member']['name'] = $userName;
      } else if (isset($requested[0]['enabled']) && $requested[0]['enabled'] === false)
        $template[0]['enabled'] = false;
    } else {
      foreach ($template as $index => $crewPosition) {

        $crewPosition['enabled'] = true;
        //Assign position to creator, or disable it
        if (isset($requested[$index]['member']) && $requested[$index]['member']['id'] === "this") {
          $crewPosition['member']['id'] = $userId;
          $crewPosition['member']['name'] = $userName;
        } else if (isset($requested[$index]['enabled']) && $requested[$index]['enabled'] === false) {
          $crewPosition['enabled'] = false;
        }

        if (!isset($crewPosition['member'])) {
          $crewPosition['member']['id'] = 0;
          $crewPosition['member']['name'] = "";
        }

        $template[$index] = $crewPosition;
      }
    }

    return $template;
  }

  private function createMiscCrewPositions($miscCrew)
  {
    $temp = null;
    if (isset($miscCrew))
      for ($i = 0; $i < $miscCrew; $i++) {
        $new = new \stdClass();
        $new->member = new \stdClass();
        $new->member->id = 0;
        $new->member->name = '';
        $temp[$i] = $new;
      }

    return $temp;
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
      'members' => 'required'
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
      $startLocation = $input['startZone'];
    } else if (isset($input['startBody'])) {
      $startLocation = $input['startBody'];
    }
    if (isset($input['targetZone'])) {
      $targetLocation = $input['targetZone'];
    } else if (isset($input['targetBody'])) {
      $targetLocation = $input['targetBody'];
    }

    /* Create Ship Crew Positions */
    $postedMembers = json_decode($input['members'], true);
    $postedShip = Ship::where('id', htmlspecialchars($input['ship_id']))->first();
    $shipPositions = json_decode($postedShip->crewPositions, true);

    if (!$postedMembers || !$postedShip || !$shipPositions) {
      return $this->sendError('Validation Error.', "Ship information was missing.");
    }

    $shipPositions = $this->createPositions($shipPositions, $postedMembers, $user->id, $user->name);

    $miscCrew = isset($input['miscCrew']) ? $this->createMiscCrewPositions($input['miscCrew']) : null;

    $scPost = ShipCrewPost::create([
      'description' => htmlspecialchars($input['description']),
      'ship_id'     => $postedShip->id,
      'creator_id'  => $user->id,
      'startLocation' => $startLocation > 0 ? $startLocation : null,
      'targetLocation' => $targetLocation > 0 ? $targetLocation : null,
      'members'     => json_encode($shipPositions, true),
      'miscCrew'    => json_encode($miscCrew, true)
    ]);

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
}
