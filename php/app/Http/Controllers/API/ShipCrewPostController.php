<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\ShipCrewPost;
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
      $scPosts = ShipCrewPosts::where('is_active', true);
  
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
          'creator_id' => 'required',
          'description' => 'required',
          'ship' => 'required'
      ]);
  
      if($validator->fails()){
          return $this->sendError('Validation Error.', $validator->errors());       
      }
  
      $scPost = ShipCrewPost::create($input);

      $scPost->isActive = true;
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
  
      if($validator->fails()){
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