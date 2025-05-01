<x-layout title="LinkLab | Subjects">
    <div class="flex flex-col min-h-screen">
        <div class="join grid grid-cols-2 my-5">
            <a href="/student/subjects" class="join-item btn btn-primary btn-square w-full">Taken Subjects</a>
            <a href="/student/subjects/available" class="join-item btn btn-square w-full">Available Subjects</a>
        </div>

        @if ($subjects->isNotEmpty())
            <div class="flex justify-center mb-20 ">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 my-5 grid-flow-row gap-x-10 gap-y-4">
                    @foreach ($subjects as $subject)
                        <a href= "{{ route('student.subjects.show', $subject) }}"
                            class="card bg-base-300 w-96 shadow-sm relative">
                            <details class="dropdown absolute top-2 right-2 ">
                                <summary class="btn m-1">
                                    <img class="w-8 h-8" src="/assets/edit.png"></img>
                                </summary>
                                <ul class="menu dropdown-content bg-base-100 right-0 rounded-box z-1 w-52 p-2 shadow-sm">
                                    <li>
                                        <form action="{{ route('student.subjects.leave', $subject) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit">Leave Subject</button>
                                        </form>
                                    </li>
                                </ul>
                            </details>
                            <figure class="px-10 pt-10 mt-10">
                                <img src="/assets/subject_background.jpg" alt="Subject image preview"
                                    class="rounded-xl" />
                            </figure>
                            <div class="card-body items-center text-center">
                                <h2 class="card-title">{{ $subject->name }}</h2>
                                <p>{{ $subject->description }}</p>
                                <p class="text-sm text-gray-500">Teacher: {{ $subject->teacher->name }}</p>
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
                            Please take one subject to preview it!
                        </p>
                    </div>
                </div>
            </div>
        @endif
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
