<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
     //member dashboard.
    public function dashboard()
    {
        $shortUrls = [];
        return view('member.dashboard', compact('shortUrls'));
    }
}
