<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

<a class="my-2" href="{{ route('anggota') }}">Anggota</a>
<a class="my-2" href="{{ route('admin') }}">Admin</a>

@if(session('error'))
    <div class="text-red-500">
        {{ session('error') }}
    </div>
@endif
</body>
</html>
