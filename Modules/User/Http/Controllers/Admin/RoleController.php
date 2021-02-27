<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\User\Entities\User;
use Modules\User\Transformers\Admin\AdminStoreRoleResource;
use Modules\User\Transformers\Errors\ValidationErrorResource;

class RoleController extends Controller
{

    /**
     * Set auth middleware
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Attribute the role to the user
     * @param Request $request
     * @return json
     */
    public function store(Request $request)
    {
        $validator = $this->validateRole($request);
        if (!$validator->fails()) {
            $user = User::where('email', $request->email)->first();
            $user->assignRolesToUsers($request->role);
            return response()->json(new AdminStoreRoleResource($user));
        }
        return response()->json(new ValidationErrorResource($validator->errors()->first()));
    }
    
    /**
     * Validation The role assigned to the user.
     *
     * @param Request $request
     * @return void
     */
    private function validateRole(Request $request)
    {
        return Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users'],
            'role' => ['required', 'max:15'],
        ]);
    }

}
