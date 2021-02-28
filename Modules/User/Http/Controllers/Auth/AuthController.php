<?php

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\User\Transformers\Auth\LoginFailedResource;
use Modules\User\Transformers\Auth\LoginResource;
use Modules\User\Transformers\Auth\LogoutResource;
use Modules\User\Transformers\Errors\ValidationErrorResource;

class AuthController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = $this->validateForm($request);
        if ($validator->fails()) {
            return response()->json(new ValidationErrorResource($validator->errors()->first()));
        }

        $credentials = $request->only(['email', 'password']);
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(new LoginFailedResource($token));
        }
            return $this->respondWithToken($token);
    }
    
    /**
     * Request Validation for login
     *
     * @param Request $request
     * @return void
     */
    private function validateForm(Request $request)
    {
        return Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required']
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user = auth()->user();
        auth()->logout();
        return response()->json(new LogoutResource($user));
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json(new LoginResource($token));
    }
}
