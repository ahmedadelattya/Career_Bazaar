<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function showRoleSelection()
    {
        return view('auth.choose-role');
    }
}
