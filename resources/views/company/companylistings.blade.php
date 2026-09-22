<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<!DOCTYPE html>
<html>
<head>
    <title>Companies</title>
</head>
<body>

    
<!-- Company listings page. -->
<div>
    <div style="text-align: right; margin-top: 10px; margin-bottom: 20px;margin-right: 70px;">
    <a href="#"
       style="padding: 8px 15px; background: lightgray; color: blue;
              text-decoration: none; font-weight: bold; border-radius: 5px;">
        + Add Company
    </a>
</div>
<h1 style="text-align: center;font-weight: bold;"><u>Companies Listing</u>  </h1>
<table border="1" cellpadding="10" style="color: black; width: 100%; border-collapse: collapse;border-color: black; margin-top: 20px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Created At</th>
        </tr>
    </thead>

    <tbody>
        @forelse($companies as $company)
            <tr>
                <td>{{ $company->id }}</td>
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
</div>





</body>
</html>
</x-app-layout>