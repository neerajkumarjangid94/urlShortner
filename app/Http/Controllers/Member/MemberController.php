<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\CompanyUser;
use App\Models\ShortUrls;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    //member dashboard.
    public function dashboard()
    {
        $shortUrls = ShortUrls::where('user_id', auth()->id())
        ->latest()
       ->paginate(10);

        return view('member.dashboard', compact('shortUrls'));
    }

    public function create()
    {
        return view('member.create-short-url');
    }


    public function store(Request $request)
    {
        $request->validate([
            'url' => ['required', 'url'],
        ]);

        $companyUser = CompanyUser::where('user_id', auth()->id())
            ->firstOrFail();

        ShortUrls::create([
            'company_id' => $companyUser->company_id,
            'user_id' => auth()->id(),
            'original_url' => $request->url,
            'short_code' => Str::random(6),
        ]);

        return redirect()
            ->route('member.dashboard')
            ->with('success', 'Short URL created successfully.');
    }
}
