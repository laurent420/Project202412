<img src="{{ asset('images/Logo1.png') }}" alt="App Logo" height="300px" width="170px" style="position: absolute; top: 0; left: 0;">
<div class="shrink-0 flex items-center">
    <a href="{{ route('dashboard') }}">
        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" class="h-10 w-auto">
    </a>
</div>

<style>
    body {
        background-image: url('{{ asset('images/bg-image.jpg') }}');
        background-size: cover;
        background-position: center;
    }
</style>