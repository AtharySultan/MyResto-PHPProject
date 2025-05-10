<!DOCTYPE html>
<html>
<head>
    <title>Admin Register</title>
</head>
<body>
    <h1>Register New Admin</h1>
    <form method="POST" action="{{ route('admin.register') }}">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" required>
            @error('password')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <button type="submit">Register</button>
    </form>
</body>
</html>