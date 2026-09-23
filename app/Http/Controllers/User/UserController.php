<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Jobs\SendInvitationMail;
use App\Models\Company;
use App\Models\Role;
use App\Models\UserInvitations;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class UserController extends Controller
{
    //invite user page view.
    public function inviteUser()
    {
        $companies = Company::latest()->get();
        return view('users.userinvitepage', compact('companies'));
    }


    //send invite for admin by super admin.
    public function storeInvitation(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'email' => 'required|email',
        ]);
        $invitation =  UserInvitations::where('company_id', $request->company_id)
            ->where('email', $request->email)
            ->whereNull('accepted_at')
            ->first();

        if (!$invitation) {
            $invitation = UserInvitations::create([
                'company_id' => $request->company_id,
                'email' => $request->email,
                'role_id' => Role::where('name', 'admin')->first()->id,
                'invited_by' => auth()->id(),
                'token' => Str::random(64),
            ]);
        }

        //send invitation email to the user.
        SendInvitationMail::dispatch($invitation);

        return back()->with('success', 'Invitation sent successfully.');
    }
}
