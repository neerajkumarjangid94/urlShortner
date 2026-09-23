<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard</title>
</head>
<body>
    <div style="width: 90%; margin: 30px auto;">
        <div style="text-align: right; margin-bottom: 20px;"><!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    style="padding: 8px 15px; background: #dc3545; color: white; border: none; border-radius: 5px;">
                    Logout
                </button>
            </form>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Short URLs</h2>
            <a href=""
                style="background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">
                + Create Short URL
            </a>
        </div>
        @if(session('success'))
            <div style="color: green; margin: 15px 0;">
                {{ session('success') }}
            </div>
        @endif
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 10px;">#</th>
                    <th style="border: 1px solid #ddd; padding: 10px;">Original URL</th>
                    <th style="border: 1px solid #ddd; padding: 10px;">Short URL</th>
                    <th style="border: 1px solid #ddd; padding: 10px;">Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($shortUrls as $shortUrl)
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 10px;">
                            {{ $loop->iteration }}
                        </td>
                        <td style="border: 1px solid #ddd; padding: 10px;">
                            {{ $shortUrl->original_url }}
                        </td>
                        <td style="border: 1px solid #ddd; padding: 10px;">
                            {{ $shortUrl->short_code }}
                        </td>
                        <td style="border: 1px solid #ddd; padding: 10px;">
                            {{ $shortUrl->created_at }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"
                            style="border: 1px solid #ddd; padding: 15px; text-align: center;">
                            No short URLs found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>