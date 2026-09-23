

    <div style="width: 500px; margin: 50px auto;">

     <a href="{{ route('company.companylistings') }}"
       style="display: inline-block; margin-bottom: 20px; color: blue; text-decoration: none;">
        ← Back to Companies
    </a>
    
        <h1 style="font-size: 25px; font-weight: bold; margin-bottom: 20px;">
            Add Company
        </h1>

        <form method="POST" action="{{ route('companies.store') }}">
            @csrf

            <div>
                <label>Company Name</label>

                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       style="width: 100%; padding: 10px; margin-top: 5px;">

                @error('name')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                    style="margin-top: 20px; padding: 10px 20px;">
                Save Company
            </button>

        </form>

    </div>

