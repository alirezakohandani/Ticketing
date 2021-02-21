<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Transformers\UserCollection;

class UserController extends Controller
{

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
        $users = User::with('roles')->get();
        return response()->json(new UserCollection($users));
    }

}