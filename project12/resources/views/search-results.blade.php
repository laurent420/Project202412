<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
</head>
<body>
    <h2>Search Results for "{{ $query }}":</h2>
    <ul>
        @forelse($results as $result)
            <li>{{ $result->name }} - {{ $result->email }}</li>
        @empty
            <li>No users found</li>
        @endforelse
    </ul>
</body>
</html>


