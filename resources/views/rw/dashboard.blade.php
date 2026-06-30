<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard RW</title>
</head>
<body>
    <h1>Dashboard RW</h1>

    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">
        Logout
    </button>
    </form>
</body>
</html>
