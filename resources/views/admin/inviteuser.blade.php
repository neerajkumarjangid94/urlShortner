<!DOCTYPE html>
<html>

<head>
    <title>Invite User</title>
</head>

<body>
    @error('email')
        <div style="color: red; margin-top: 5px;">
            {{ $email }}
        </div>
    @enderror
    <div style="width: 500px; margin: 80px auto;">
        <h1 style="text-align: center;">
            <u>Invite User</u>
        </h1>
        <form method="POST" action="{{ route('admin.invite.send') }}" style="margin-top: 30px;">
            @csrf
            <div style="margin-top: 30px;">
                <label for="email">
                    Gmail / Email
                </label>
                <br>
                <input type="email" id="email"
                    name="email" placeholder="Enter email address" required
                    style="width: 100%;padding: 10px;margin-top: 8px;box-sizing: border-box;">
            </div>

            <!-- Role -->
            <div style="margin-top: 20px;">
                <label for="role_id">
                    Select Role
                </label>
                <br>
                <select
                    id="role_id"
                    name="role_id"
                    required
                    style="width: 100%; padding: 10px; margin-top: 8px;">

                    <option value="">
                        Select Role
                    </option>

                    @foreach($roles as $role)
                    <option value="{{ $role->id }}">
                        {{ $role->name }}
                    </option>
                    @endforeach

                </select>
            </div>
 

            <!-- Submit -->
            <div style="text-align: center; margin-top: 30px;">
                <button
                    type="submit" style="padding: 10px 25px; background: lightgray;
                           color: blue; border: 1px solid gray;
                           font-weight: bold;  border-radius: 5px; cursor: pointer;">
                    Send Invitation
                </button>
            </div>
        </form>

        <!-- Back -->
        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('admin.dashboard') }}">
                Back to Dashboard
            </a>
        </div>
    </div>
</body>

</html>