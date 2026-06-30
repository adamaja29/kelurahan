<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard RT</title>
</head>
<body>
    <h1>Dashboard RT</h1>

    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">
        Logout
    </button>
    </form>
</body>
</html>
