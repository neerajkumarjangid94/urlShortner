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

    <div>
<a href="{{ route('admin.short-url.create') }}"
    style="padding: 8px 15px; background: lightgray; color: green;
    text-decoration: none; font-weight: bold; border-radius: 5px;">
    + Create Short URL
</a>
    </div>

   
    @if(session('success'))
    <div style="color: green; margin: 15px 0;">
        {{ session('success') }}
    </div>
    @endif
    <h3 style="margin-top: 30px;">Company Short URLs</h3>
    <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 10px;">#</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Created By</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Original URL</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Short URL</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($shortUrls as $shortUrl)
            <tr>
                <td style="border: 1px solid #ddd; padding: 10px;">
                    {{ $shortUrls->firstItem() + $loop->index }}
                </td>
                <td style="border: 1px solid #ddd; padding: 10px;">
                    {{ $shortUrl->user->name }}
                </td>
                <td style="border: 1px solid #ddd; padding: 10px;">
                    {{ $shortUrl->original_url }}
                </td>
                <td style="border: 1px solid #ddd; padding: 10px;">
                    <a href="{{ route('short-url.redirect', $shortUrl->short_code) }}"
                        target="_blank">
                        {{ url($shortUrl->short_code) }}
                    </a>
                </td>
                <td style="border: 1px solid #ddd; padding: 10px;">
                    {{ $shortUrl->created_at }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5"
                    style="border: 1px solid #ddd; padding: 15px; text-align: center;">
                    No short URLs found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <!-- Pagination -->
    <div style="margin-top: 20px;">
        {{ $shortUrls->links('pagination::simple-tailwind') }}
    </div>
</body>

</html>