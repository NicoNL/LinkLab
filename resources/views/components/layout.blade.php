<!DOCTYPE html>
<html data-theme="night" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Default Title' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.23/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="{{ asset('assets/logo_gray.png') }}">
</head>

<body class="flex flex-col min-h-screen">
    <div class="navbar bg-base-100 shadow-sm mx-100">
        <div class="flex-1">
            <a href="/" class="btn btn-ghost text-xl">LinkLab</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                @auth
                    @php
                        $user = auth()->user();
                        $dashboardUrl = $user->isTeacher() ? '/teacher/subjects' : '/student/subjects';
                    @endphp
                    </li>
                    <li>
                        <details>
                            <summary>
                                <div class="avatar">
                                    <div class="w-10 rounded-full">
                                        <img
                                            src="/assets/profile.png" />
                                    </div>
                                </div>
                            </summary>
                            <ul class="bg-base-100 rounded-t-none right-0 p-2">
                                <li><a href="{{ $dashboardUrl }}">Subjects</a>
                                <li><a href="/contact">Contact</a></li>
                                <li><a href="/profile">Profile</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </details>
                    </li>
                @else
                    <li><a href="/login">Login</a></li>
                    <li><a href="/contact">Contact</a></li>
                @endauth
            </ul>
        </div>
    </div>
    <div class="flex-grow">
        {{ $slot }}
    </div>
    <footer class="footer sm:footer-horizontal bg-neutral text-neutral-content p-10 flex justify-center">
        <div class="flex flex-col items-center text-center">
            <img src="{{ asset('assets/logo_gray.png') }}" alt="Social Vista logo" class="w-10 h-auto rounded-lg">
            <p class="text-xs">
                LinkLab
                <br />
                Connecting students and professors
            </p>
        </div>
    </footer>
</body>

</html>
