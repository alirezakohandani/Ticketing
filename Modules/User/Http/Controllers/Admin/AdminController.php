<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Modules\User\Transformers\Admin\AdminStorePermissionResource;
use Modules\User\Transformers\Admin\AdminStoreRoleResource;

class AdminController extends Controller
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
    public function storeRole(Request $request)
    {
        $this->validateRole($request);
        $user = User::where('email', $request->email)->first();
        $user->assignRolesToUsers($request->role);
        return response()->json(new AdminStoreRoleResource($user));
    }

    /**
     * Validation The role assigned to the user.
     *
     * @param Request $request
     * @return void
     */
    private function validateRole(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'role' => ['required', 'max:15'],
        ]);
    }

    /**
     * Attribute the permission to the role
     *
     * @param Request $request
     * @return json
     */
    public function storePermission(Request $request)
    {
        $this->validatePermission($request);
        $role = Role::where('role', $request->role)->first();
        $role->assignPermissionToRoles($request->permission);
        return response()->json(new AdminStorePermissionResource($role));
    }

    /**
     * Validation permission is assigned to the role.
     *
     * @param Request $request
     * @return void
     */
    private function validatePermission(Request $request)
    {
        $request->validate([
            'role' => ['required', 'exists:roles'],
            'permission' => ['required', 'max:20'],
        ]);
    }

}
