<!-- resources/views/searchform.blade.php -->

<form action="{{ route('search') }}" method="GET">
    <input type="text" name="query" required>
    <button type="submit">Search</button>
</form>

</html>
