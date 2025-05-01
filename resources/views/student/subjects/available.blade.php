<x-layout title="LinkLab | Subjects">
    <div class="flex flex-col min-h-screen ">
        <div class="join grid grid-cols-2 my-5">
            <a href="/student/subjects" class="join-item btn btn-square w-full">Taken Subjects</a>
            <a href="/student" class="join-item btn btn-primary btn-square w-full">Available Subjects</a>
        </div>

        @if ($availableSubjects->isNotEmpty())
            <div class="flex justify-center mb-20 ">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 my-5 grid-flow-row gap-x-10 gap-y-4">
                    @foreach ($availableSubjects as $subject)
                        <div class="card bg-base-300 w-96 shadow-sm">
                            <figure class="px-10 pt-10">
                                <img src="/assets/subject_background.jpg" alt="Shoes" class="rounded-xl" />
                            </figure>
                            <div class="card-body items-center text-center">
                                <h2 class="card-title">{{ $subject->name }}</h2>
                                <p>{{ $subject->description }}</p>
                                <p class="text-sm text-gray-500">Teacher: {{ $subject->teacher->name }}</p>
                                <p class="text-sm text-gray-500">Credits: {{ $subject->credit }}</p>
                                <p class="text-sm text-gray-500">Code: {{ $subject->code }}</p>

                                <div class="card-actions">
                                    <form action="{{ route('student.subjects.take', $subject) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary mt-3">Take</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="hero bg-base-200 min-h-screen mb-20">
                <div class="hero-content text-center">
                    <div class="max-w-md">
                        <h1 class="text-5xl font-bold">No subjects were found</h1>
                        <p class="py-6">
                            There are not available subject for you at the moment!
                        </p>
                    </div>
                </div>
            </div>
        @endif
        <br>

    </div>
</x-layout>
