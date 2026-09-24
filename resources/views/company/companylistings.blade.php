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

               <a href="{{ route('users.invite') }}"
                style="padding: 8px 15px; background: lightgray; color: blue;
              text-decoration: none; font-weight: bold; border-radius: 5px;">+ Invite User</a>
        </div>
        <!-- <div style="text-align: right; margin-top: 10px; margin-bottom: 20px;margin-right: 70px;">
           
        </div> -->
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


    <div style="margin-top: 50px;">
        <h1 style="text-align: center; font-weight: bold;">
            <u>All Short URLs</u>
        </h1>
        <form method="GET"
            action="{{ route('company.companylistings') }}"
            style="text-align: center; margin: 25px 0;">

            <input
                type="text"
                name="company"
                value="{{ request('company') }}"
                placeholder="Search company name"
                style="width: 300px; padding: 10px;">

            <button type="submit"
                style="padding: 10px 20px; margin-left: 5px;">
                Search
            </button>

            @if(request('company'))

            <a href="{{ route('company.companylistings') }}"
                style="margin-left: 10px;">
                Clear
            </a>

            @endif

        </form>
        <table border="1" cellpadding="10"
            style="color: black; width: 100%; border-collapse: collapse;
            border-color: black; margin-top: 20px;">

            <thead>

                <tr>

                    <th>#</th>

                    <th>Company Name</th>

                    <th>Created By</th>

                    <th>Original URL</th>

                    <th>Short URL</th>

                    <th>Created At</th>

                </tr>

            </thead>


            <tbody>

                @forelse($shortUrls as $shortUrl)

                <tr>

                    <td>
                        {{ $shortUrls->firstItem() + $loop->index }}
                    </td>

                    <td>
                        {{ $shortUrl->company->name }}
                    </td>

                    <td>
                        {{ $shortUrl->user->name }}
                    </td>

                    <td>
                        {{ $shortUrl->original_url }}
                    </td>

                    <td>

                        <a href="{{ route('short-url.redirect', $shortUrl->short_code) }}"
                            target="_blank">

                            {{ url($shortUrl->short_code) }}

                        </a>

                    </td>

                    <td>
                        {{ $shortUrl->created_at }}
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6"
                        style="text-align: center;">

                        No short URLs found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>
        <div style="margin-top: 20px;">

            {{ $shortUrls->links('pagination::simple-tailwind') }}

        </div>

    </div>


</body>

</html>