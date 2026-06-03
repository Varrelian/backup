<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>SchoolEvent - @yield('title')</title>
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css
" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">

<div class="container">
<a class="navbar-brand fw-bold" href="/">SchoolEvent</a>
<div class="collapse navbar-collapse">
<ul class="navbar-nav ms-auto">
<li class="nav-item"><a class="nav-link"
href="/">Home</a></li>
<li class="nav-item"><a class="nav-link"
href="/dashboard">Dashboard</a></li>
</ul>
</div>
</div>
</nav>
<div class="container">
@yield('content')
</div>
<footer class="text-center py-4 mt-5 border-top">
<p class="text-muted">&copy; 2026 SMK Plus Pelita Nusantara</p>
</footer>
</body>
</html>