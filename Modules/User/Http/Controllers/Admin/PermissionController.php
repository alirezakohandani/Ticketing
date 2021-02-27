<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\User\Entities\Role;
use Modules\User\Transformers\Admin\AdminStorePermissionResource;
use Modules\User\Transformers\Errors\ValidationErrorResource;

class PermissionController extends Controller
{

    /**
     * Set auth middleware
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
   /**
     * Attribute the permission to the role
     *
     * @param Request $request
     * @return json
     */
    public function store(Request $request)
    {
        $validator = $this->validateForm($request);
        if (!$validator->fails()) {
            $role = Role::where('role', $request->role)->first();
            $role->assignPermissionToRoles($request->permission);
            return response()->json(new AdminStorePermissionResource($role));
        }
            return response()->json(new ValidationErrorResource($validator->errors()->first()));
    }

    /**
     * Validation permission is assigned to the role.
     *
     * @param Request $request
     * @return void
     */
    private function validateForm(Request $request)
    {
        return Validator::make($request->all(), [
            'role' => ['required', 'exists:roles'],
            'permission' => ['required', 'max:20'],
        ]);
    }

}
