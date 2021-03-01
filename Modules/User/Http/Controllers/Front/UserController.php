<?php

namespace Modules\User\Http\Controllers\Front;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Transformers\Admin\Errors\AdminIndexPermissionResource;
use Modules\User\Transformers\UserCollection;

class UserController extends Controller
{

    /**
     * Set auth middleware
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the users.
     * @return json
     */

    public function index()
    {
        if(!\Gate::any(['see users', 'super_admin']))
        {
            return response()->json(new AdminIndexPermissionResource(auth()->user()));
        }
        $users = User::with('roles')->paginate(10);
        return response()->json(new UserCollection($users));
    }

}