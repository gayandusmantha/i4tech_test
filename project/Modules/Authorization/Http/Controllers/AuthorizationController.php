<?php

namespace Modules\Authorization\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{

    /**
     * Check user is validate.
     * @return Json
     */
    public function validateToken(): Json
    {
        $res = Auth::guard('api')->check();
        return response()->json($res, 200);
    }




}
