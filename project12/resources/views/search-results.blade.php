<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
</head>
<body>
    <h1>Search Results for "{{ $query }}"</h1>
    
    @if($results->isEmpty())
        <p>No results found.</p>
    @else
        <ul>
            @foreach ($results as $result)
                <li>{{ $result->name }} ({{ $result->email }})</li>
            @endforeach
        </ul>
    @endif
</body>
</html>

