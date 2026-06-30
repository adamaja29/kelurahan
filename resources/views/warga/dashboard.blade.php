<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman utama</title>
</head>
<body>
    <h1>Pengguna Dashboard</h1>

    <form action="{{ route('logoutWarga') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">
        Logout
    </button>
</form>
</body>
</html>