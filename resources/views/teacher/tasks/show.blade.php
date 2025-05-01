<x-layout title="LinkLab | {{ $task->name }}">
    <div class="flexbox mx-20 min-h-screen">
        <div class="Task Information">
            <figure>
                <img src="/assets/subject_background.jpg" alt="Subject image preview"
                    class=" w-full rounded-xl h-40 object-cover" />
            </figure>
            <div class="flex justify-between my-5">
                <div>
                    <a href="{{ route('teacher.subjects.show', $task->subject) }}"
                        class="text-5xl font-bold text-primary underline">{{ $task->subject->name }}</a>
                    <div class="text-3xl font-bold text-secondary">-> {{ $task->name }}</div>
                </div>
                <details class="dropdown">
                    <summary class="btn m-1">
                        <img class="w-8 h-8" src="/assets/edit.png"></img>
                    </summary>
                    <ul class="menu dropdown-content bg-base-100 right-0 rounded-box z-1 w-52 p-2 shadow-sm">
                        <li>
                            <a class="btn " href="{{ route('teacher.tasks.edit', [$subject, $task]) }}"
                                method="POST">Edit Task </a>
                        </li>
                        <li class="flex justify-center">
                            <form action="{{ route('teacher.tasks.destroy', [$subject, $task]) }}" method="POST"
                                class="flex justify-center w-full">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-lg text-md" type="submit">Delete Task</button>
                            </form>
                        </li>
                    </ul>
                </details>
            </div>
            <div class="badge badge-primary text-xl">Task description</div>

            <p class="text-lg my-5 ">-> {{ $task->description }}</p>
            <div class="badge badge-info text-lg">
                <svg class="size-[1em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g fill="currentColor" stroke-linejoin="miter" stroke-linecap="butt">
                        <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor"
                            stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></circle>
                        <path d="m12,17v-5.5c0-.276-.224-.5-.5-.5h-1.5" fill="none" stroke="currentColor"
                            stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></path>
                        <circle cx="12" cy="7.25" r="1.25" fill="currentColor" stroke-width="2"></circle>
                    </g>
                </svg>
                ->Points: {{ $task->points }}
            </div>
            <div class="my-8">
                <div class="badge badge-primary text-lg mb-4">Students: {{ $subject->students->count() }}</div>
                <form action="{{ route('teacher.solutions.gradeAll', [$subject, $task]) }}" method="POST">
                    @csrf
                    <div class="overflow-x-auto flex justify-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Email</th>
                                    <th>Submission Status</th>
                                    <th>Submission Date</th>
                                    <th>File</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subject->students as $student)
                                    <tr>
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <div class="avatar">
                                                    <div class="mask mask-squircle h-12 w-12">
                                                        <img src="/assets/profile.png" alt="Student avatar" />
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="font-bold">{{ $student->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $student->email }}</td>
                                        <td>
                                            @php
                                                $solution = $task->solutions()->where('user_id', $student->id)->first();
                                            @endphp
                                            @if ($solution)
                                                <span class="badge badge-success">Submitted</span>
                                            @else
                                                <span class="badge badge-error">Not Submitted</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($solution)
                                                {{ $solution->created_at->format('Y-m-d H:i') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($solution)
                                                <a href="{{ route('teacher.solutions.download', $solution) }}"
                                                    class="underline text-primary">Download</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($solution)
                                                <input type="number" name="grades[{{ $solution->id }}]"
                                                    value="{{ $solution->points }}" min="0"
                                                    max="{{ $task->points }}" class="input input-bordered w-20"
                                                    placeholder="0-{{ $task->points }}" />
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-center mt-8">
                        <button type="submit" class="btn btn-primary">Save All Grades</button>
                    </div>
                </form>
            </div>
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
    </div>
</x-layout>
