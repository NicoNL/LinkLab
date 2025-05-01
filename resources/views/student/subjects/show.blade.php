<x-layout title="LinkLab | {{ $subject->name }}">
    <div class="flex flex-col mx-20">
        <div class="Subject Information">
            <figure>
                <img src="/assets/subject_background.jpg" alt="Subject image preview"
                    class=" w-full rounded-xl h-40 object-cover" />
            </figure>
            <div class="flex justify-between mt-5">
                <div class="text-5xl font-bold text-primary">{{ $subject->name }}</div>
                <details class="dropdown">
                    <summary class="btn m-1">
                        <img class="w-8 h-8" src="/assets/edit.png"></img>
                    </summary>
                    <ul class="menu dropdown-content bg-base-100 right-0 rounded-box z-1 w-52 p-2 shadow-sm">
                        <li>
                            <form action="{{ route('student.subjects.leave', $subject) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn w-full"type="submit">Leave Subject</button>
                            </form>
                        </li>
                    </ul>
                </details>
            </div>
            <p class="text-md text-gray-500 mb-5">Teacher: {{ $subject->teacher->name }}</p>

            <div class="badge badge-primary text-xl">Subject description</div>
            <p class="text-lg mb-5 ">-> {{ $subject->description }}</p>

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
                ->Credits: {{ $subject->credit }}
            </div>
            <br>
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
                ->Code: {{ $subject->code }}
            </div>
        </div>

        <div class="mt-8">
            <div class="badge badge-primary text-lg mb-4">Tasks</div>

            @if ($subject->tasks->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($subject->tasks as $task)
                        <div class="card bg-base-200 shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title">{{ $task->name }}</h2>
                                <p class="text-sm text-gray-500">Points: {{ $task->points }}</p>
                                <p>{{ $task->description }}</p>
                                @if ($task->solutions->count() > 0)
                                    @php
                                        $solution = $task->solutions->first();
                                    @endphp
                                    <div class="badge badge-success">Completed</div>
                                    @if($solution->points !== null)
                                        <div class="badge badge-info">Grade: {{ $solution->points }}/{{ $task->points }}</div>
                                    @endif
                                @else
                                    <div class="badge badge-error">Not Completed</div>
                                @endif
                                <div class="card-actions justify-end mt-4">
                                    <a href="{{ route('student.tasks.show', [$subject, $task]) }}"
                                        class="btn btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No tasks available for this subject.</p>
            @endif
        </div>
        <div class="my-8">
            <div class="badge badge-primary text-lg mb-4">Students: {{ $subject->students->count() }}</div>
            <div class="overflow-x-auto flex justify-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($subject->students as $student)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="mask mask-squircle h-12 w-12">
                                            <img src="/assets/profile.png"
                                                alt="Student avatar" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold">{{ $student->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $student->email }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
