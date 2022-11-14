<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\BasicApiController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class LoginController extends BasicApiController
{
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        return auth()->attempt($this->credentials($request))
                ? $this->sendResponse('User login successfully.', self::createToken())
                : $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
    }

    /**
     * refresh api
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh()
    {
        return $this->sendResponse('Token refreshed successfully.', self::createToken());
    }

    /**
     * authenticatedUserDetails api
     *
     *  @return \Illuminate\Http\Response
     */
    public function authenticatedUserDetails()
    {
        return new UserResource(auth()->user());
    }

    /**
     * saveAuthMobileToken api
     *
     *  @return \Illuminate\Http\Response
     */
    public function saveMobileToken(){
        if (! request()->mobile_token)
            return response()->json(['status' => "failed", 'message' => 'Mobile token is requied!'], 422);

        auth()->user()->update(['mobile_token' => request('mobile_token')]);
        // return response()->json(['status' => "success", 'message' => 'Mobile token saved successfully!'], 200);
        return $this->sendResponse('Mobile token saved successfully.', self::createToken());
    }

    protected function createToken()
    {
        self::deleteOldTokens();
        return [
            'token' => "Bearer ".auth()->user()->createToken(env('API_HASH_TOKEN', 'ClubApp'))->accessToken,
            'user'  => new UserResource(auth()->user()),
        ];
    }

    protected function credentials(Request $request)
    {
        return [
            'email' => $request->email,
            'password' => $request->password
        ];
    }

    protected function deleteOldTokens()
    {
        auth()->user()->tokens()->delete();
    }
}
