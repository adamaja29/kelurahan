<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Warga</title>
</head>
<body>

    <h1>LOGIN WARGA</h1>

    <h2>Form Login</h2>

    <form action="{{ route('prosesLoginWarga') }}" method="POST">
        @csrf
        <p>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required>
        </p>

        <p>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required>
        </p>

        <p>
            <button type="submit">Masuk</button>
        </p>
    </form>

</body>
</html>