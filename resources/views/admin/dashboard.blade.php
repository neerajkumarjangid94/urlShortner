<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
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


    <!-- Invite Button -->
    <div style="text-align: right; margin-top: 10px; margin-bottom: 20px;margin-right: 70px;">
            <a href="{{ route('admin.invite') }}"
                style="padding: 8px 15px; background: lightgray; color: blue;
              text-decoration: none; font-weight: bold; border-radius: 5px;">+ Invite User</a>
        </div>
        


   


  




</body>

</html>