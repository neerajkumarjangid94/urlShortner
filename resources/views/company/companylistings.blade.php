<!DOCTYPE html>
<html>

<head>
    <title>Companies</title>
</head>

<body>
   <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}" style="text-align: right; margin: 20px 70px 10px 0;">
        @csrf

        <button type="submit"
            style="padding: 8px 15px; background: lightgray; color: red;
            border: 1px solid gray; font-weight: bold; border-radius: 5px;
            cursor: pointer;">
            Logout
        </button>
    </form>

     <!-- Company -->
    <div>
        <div style="text-align: right; margin-top: 10px; margin-bottom: 20px;margin-right: 70px;">
            <a href="{{ route('companies.create') }}"
                style="padding: 8px 15px; background: lightgray; color: blue;
              text-decoration: none; font-weight: bold; border-radius: 5px;">+ Add Company</a>
        </div>
        <div style="text-align: right; margin-top: 10px; margin-bottom: 20px;margin-right: 70px;">
            <a href="{{ route('users.invite') }}"
                style="padding: 8px 15px; background: lightgray; color: blue;
              text-decoration: none; font-weight: bold; border-radius: 5px;">+ Invite User</a>
        </div>
        <h1 style="text-align: center;font-weight: bold;"><u>Companies Listing</u> </h1>
        <table border="1" cellpadding="10" style="color: black; width: 100%; border-collapse: collapse;border-color: black; margin-top: 20px;">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Created At</th>
                </tr>
            </thead>

            <tbody>
                @forelse($companies as $company)
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->created_at }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center;">
                        No companies found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top: 20px;">
         {{ $companies->links('pagination::simple-tailwind') }}
        </div>
    </div>

    <!-- User -->
     <!-- <div style="margin-top: 100px;">
         <div style="text-align: right; margin-top: 10px; margin-bottom: 20px;margin-right: 70px;">
            <a href="{{ route('users.invite') }}"
                style="padding: 8px 15px; background: lightgray; color: blue;
              text-decoration: none; font-weight: bold; border-radius: 5px;">+ Invite User</a>
        </div>

        <h1 style="text-align: center;font-weight: bold;"><u>User Listing</u> </h1>
        <table border="1" cellpadding="10" style="color: black; width: 100%; border-collapse: collapse;border-color: black; margin-top: 20px;">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Role</th>
                    <th>Created At</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role?->name }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center;">
                        No users found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top: 20px;">
         {{ $users->links('pagination::simple-tailwind') }}
        </div>
    </div> -->
</body>

</html>