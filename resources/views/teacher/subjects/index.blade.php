<x-layout title="LinkLab | Subjects">
    <div class="flex flex-col min-h-screen">
        <h1 class="text-5xl font-bold text-primary text-center my-8">My Subjects</h1>
        @if ($subjects->isNotEmpty())
            <div class="flex justify-center mb-20 ">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 my-5 grid-flow-row gap-x-10 gap-y-4">
                    @foreach ($subjects as $subject)
                        <a href= "{{ route('teacher.subjects.show', $subject) }}"
                            class="card bg-base-300 w-96 shadow-sm relative">
                            <figure class="px-10 pt-10">
                                <img src="/assets/subject_background.jpg" alt="Subject image preview"
                                    class="rounded-xl" />
                            </figure>
                            <div class="card-body items-center text-center">
                                <h2 class="card-title">{{ $subject->name }}</h2>
                                <p>{{ $subject->description }}</p>
                                <p class="text-sm text-gray-500">Credits: {{ $subject->credit }}</p>
                                <p class="text-sm text-gray-500">Code: {{ $subject->code }}</p>
                                <div class="card-actions">
                                    <button type="submit" class="btn btn-primary mt-3">Open</button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <div class="hero bg-base-200 min-h-screen mb-20">
                <div class="hero-content text-center">
                    <div class="max-w-md">
                        <h1 class="text-5xl font-bold">No subjects were found</h1>
                        <p class="py-6">
                            Start creating a new subjects for the students!
                        </p>
                    </div>
                </div>
            </div>
        @endif
        <a href="{{ route('teacher.subjects.create') }}"class="btn btn-success  mx-auto">New Subject</a>
        <br>
        @if (session('success'))
            <div class="toast">
                <div class="alert alert-success">
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            <script>
                setTimeout(() => {
                    document.querySelector('.toast').remove();
                }, 5000);
            </script>
        @endif
    </div>
</x-layout>