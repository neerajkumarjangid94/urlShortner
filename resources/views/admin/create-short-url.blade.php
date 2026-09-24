<!DOCTYPE html>
<html>
<head>
    <title>Create Short URL</title>
</head>
<body>
    <div style="width: 500px; margin: 50px auto;">
        <h2>Create Short URL</h2>
        <form method="POST" action="{{ route('admin.short-url.store') }}">
            @csrf
            <div style="margin-top: 20px;">
                <label for="url">Enter URL</label>
                <input
                    type="url"
                    id="url"
                    name="url"
                    value="{{ old('url') }}"
                    placeholder="https://example.com"
                    required
                    style="width: 100%; padding: 10px; margin-top: 8px; box-sizing: border-box;">
                @error('url')
                    <div style="color: red; margin-top: 5px;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div style="margin-top: 20px;">
                <button
                    type="submit"
                    style="padding: 10px 20px; background: green; color: white;
                    border: none; border-radius: 5px; cursor: pointer;">
                    Create Short URL
                </button>
                <a href="{{ route('admin.dashboard') }}"
                    style="margin-left: 10px;">
                    Back
                </a>
            </div>
        </form>
    </div>
</body>
</html>