<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-color: #f4f7fc;">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
        <div class="container">
            @php
                $dashboardRoute = '#';
                if (auth()->check()) {
                    $role = auth()->user()->role;

                    if ($role === 'admin') {
                        $dashboardRoute = route('admin.dashboard');
                    } elseif ($role === 'employer') {
                        $dashboardRoute = route('employer.dashboard');
                    } elseif ($role === 'jobseeker') {
                        $dashboardRoute = route('jobseeker.dashboard');
                    }
                }
            @endphp

            <a class="navbar-brand" href="{{ $dashboardRoute }}">Dashboard</a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    @if(auth()->check())
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
