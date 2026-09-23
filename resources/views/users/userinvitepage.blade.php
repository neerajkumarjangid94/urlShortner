<div style="width: 500px; margin: 50px auto;">

    <a href="{{ route('company.companylistings') }}">
        ← Back
    </a>

    <h1 style="font-size: 25px; font-weight: bold; margin: 20px 0;">
        Invite User
    </h1>

    <form method="POST" action="{{ route('users.invite.store') }}">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>Company</label>

            <select name="company_id"
                style="width: 100%; padding: 10px;">
                <option value="">Select Company</option>

                @foreach($companies as $company)
                <option value="{{ $company->id }}">
                    {{ $company->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Email</label>

            <input type="email"
                name="email"
                placeholder="Enter email"
                style="width: 100%; padding: 10px;">
        </div>

        <button type="submit"
            style="margin-top: 20px; padding: 10px 20px;">
            Send Invite
        </button>

    </form>

</div>