<!DOCTYPE html>
<html>
<head>
    <title>GreenLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-success px-3">
    <a class="navbar-brand" href="/dashboard">GreenLink</a>

    <div>
        <a href="/dashboard" class="text-white me-3">Dashboard</a>
        <a href="/logout" class="text-white">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>