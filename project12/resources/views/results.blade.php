<h1>Search Results</h1>

@if($users->isEmpty())
    <p>No results found.</p>
@else
    @foreach($users as $user)
        <p>{{ $user->name }}</p>
    @endforeach
@endif
