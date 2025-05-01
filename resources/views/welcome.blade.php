<x-layout title="LinkLab | MainPage">
    <div class="hero min-h-screen" style="background-image: url(/assets/students_cyan.gif);">
        <div class="hero-overlay"></div>
        <div class="hero-content text-neutral-content text-center">
            <div class="max-w-md">
                <h1 class="mb-5 text-5xl font-bold">Welcome!</h1>
                <p class="mb-5 text-lg font-bold">
                    This is an intuitive platform designed to help you visualize and manage subjects.
                    Perfect for students, educators, and institutions.
                </p>
                @auth
                    @php
                        $user = auth()->user();
                        $dashboardUrl = $user->isTeacher() ? '/teacher/subjects' : '/student/subjects';
                    @endphp
                    <a href="{{$dashboardUrl  }}" class="btn btn-primary">Get Started</a>
                @else
                    <a href="/login" class="btn btn-primary">Get Started</a>
                @endauth
            </div>
        </div>
    </div>
</x-layout>
