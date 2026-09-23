<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendInvitationMail;
use App\Models\CompanyUser;
use App\Models\Role;
use App\Models\User;
use App\Models\UserInvitations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    //register page show.
    public function showRegistration($token)
    {
        if (!$token) {
            abort(403, 'Invalid invitation token.');
        }

        try {
            $invitation = UserInvitations::where('token', $token)
                ->whereNull('accepted_at')
                ->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(403, 'Invalid invitation token, or the invitation has already been accepted.');
        }

        return view('auth.register', compact('invitation'));
    }

    //admin dashboard.
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    //invite user page view.
    public function inviteUser()
    {
           $roles = Role::whereIn('name', ['Admin', 'Member'])->get();
        return view('admin.inviteuser', compact('roles'));
    }

    public function sendInvitation(Request $request)
    {
        
        $request->validate([
            'email' => ['required', 'email'],
            'role_id' => ['required', 'exists:roles,id'],
        ]);

        // fetch company -id from admin auth user.
        $companyUser = CompanyUser::where('user_id', auth()->id())
            ->firstOrFail();

        // check gmail alreadyexists or in invitation table.
        $invitation = UserInvitations::where('email', $request->email)
            ->whereNull('accepted_at')
            ->first();
        if (!$invitation && User::where('email', $request->email)->exists()) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'This email is already registered.',
                ]);
        }

        if (!$invitation) {
            $invitation = UserInvitations::create([
                'company_id' => $companyUser->company_id,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'invited_by' => auth()->id(),
                'token' => Str::random(64),
            ]);
        }

        // Send invitation email
        SendInvitationMail::dispatch($invitation);

        return redirect()
            ->route('admin.invite')
            ->with('success', 'Invitation sent successfully.');
    }
}
