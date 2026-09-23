<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CompanyUser;
use App\Models\Role;
use App\Models\User;
use App\Models\UserInvitations;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'token' => ['required', 'string'],
        ]);

        $invitation = UserInvitations::where('token', $request->token)
            ->where('email', $request->email)
            ->whereNull('accepted_at')
            ->firstOrFail();

        $user = DB::transaction(function () use ($request, $invitation) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $invitation->role_id,
            ]);

            CompanyUser::create([
                'company_id' => $invitation->company_id,
                'user_id' => $user->id,
                'role_id' => $invitation->role_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $invitation->update([
                'accepted_at' => now(),
            ]);
            return $user;
        });



        event(new Registered($user));

        Auth::login($user);


        if ($user->role_id == Role::SUPER_ADMIN_ID) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('member.dashboard');

     
        // return redirect(route('dashboard', absolute: false));
    }
}
