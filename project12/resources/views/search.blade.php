<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Users</title>
</head>
<body>
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search users..." required>
        <button type="submit">Search</button>
    </form>

    @if(isset($results))
        <h2>Search Results for "{{ $query }}":</h2>
        <ul>
            @forelse($results as $result)
                <li>{{ $result->name }} - {{ $result->email }}</li>
            @empty
                <li>No users found</li>
            @endforelse
        </ul>
    @endif
</body>
</html>
