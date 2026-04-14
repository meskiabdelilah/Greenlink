<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 380px">

        <h3 class="text-center text-success mb-3">Create Account</h3>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf

            <input type="text" name="name" class="form-control mb-2" placeholder="Name">

            <input type="email" name="email" class="form-control mb-2" placeholder="Email">

            <input type="password" name="password" class="form-control mb-3" placeholder="Password">

            <button class="btn btn-success w-100">Register</button>
        </form>

        <p class="text-center mt-3">
            Already have account?
            <a href="/login">Login</a>
        </p>

    </div>

</div>

</body>
</html>