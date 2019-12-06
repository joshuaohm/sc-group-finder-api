<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Validator;

class RegisterController extends BaseController
{
  public $successStatus = 200;

  /**
   * Register api
   *
   * @return \Illuminate\Http\Response
   */
  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'password' => 'required',
      'c_password' => 'required|same:password',
    ]);

    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }

    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $success['token'] =  $user->createToken('SCGF')->accessToken;

    return $this->sendResponse($success, 'User register successfully.');
  }

  /**
   * Login api
   *
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request)
  {
    //User is already logged in
    if (Auth::user()) {
      $success['token'] = $request->bearerToken();
      $success['id'] = Auth::user()->id;
      $success['name'] = Auth::user()->name;

      return $this->sendResponse($success, 'User login successfully.');
    }
    //User is not logged in yet
    else if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
      $user = Auth::user();
      $success['token'] =  $user->createToken('SCGF')->accessToken;
      $success['id'] = $user->id;
      $success['name'] = $user->name;

      return $this->sendResponse($success, 'User login successfully.');
    } else {
      return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    }
  }

  /**
   * LoginCheck api
   *
   * @return \Illuminate\Http\Response
   */
  public function loginCheck(Request $request)
  {
    if ($user = Auth::user()) {

      $success['token'] = $request->bearerToken();
      $success['id'] = Auth::user()->id;
      $success['name'] = Auth::user()->name;

      return $this->sendResponse($success, 'User is logged in.');
    } else
      return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
  }

  /**
   * LogOut api
   *
   * @return \Illuminate\Http\Response
   */
  public function logOut(Request $request)
  {

    if (Auth::user()) {

      DB::table('oauth_access_tokens')
        ->where('user_id', Auth::user()->id)
        ->update([
          'revoked' => true
        ]);

      $success['token'] = '';

      return $this->sendResponse($success, 'User logged out successfully.');
    } else
      return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
  }
}
