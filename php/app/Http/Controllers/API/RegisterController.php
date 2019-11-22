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
    $success['token'] =  $user->createToken('MyApp')->accessToken;

    return $this->sendResponse($success, 'User register successfully.');
  }

  /**
   * Login api
   *
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request)
  {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
      $user = Auth::user();
      $success['token'] =  $user->createToken('MyApp')->accessToken;

      Cookie::queue('scgf-token', $success['token'] , 60 * 24);

      return $this->sendResponse($success, 'User login successfully.');
    } else {
      return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    }
  }

  /**
   * Login api
   *
   * @return \Illuminate\Http\Response
   */
  public function logOut(Request $request){

    DB::table('oauth_access_tokens')
      ->where('user_id', Auth::user()->id)
      ->update([
        'revoked' => true
      ]);

    $success['token'] = '';

    return $this->sendResponse($success, 'User logged out successfully.');
  }
}
