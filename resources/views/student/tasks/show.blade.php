<x-layout title="LinkLab | {{ $task->name }}">
    <div class="flexbox mx-20 min-h-screen">
        <div class="Task Information">
            <figure>
                <img src="/assets/subject_background.jpg" alt="Subject image preview"
                    class=" w-full rounded-xl h-40 object-cover" />
            </figure>
            <div class="mt-5">
                <a href="{{ route('student.subjects.show', $task->subject) }}"
                    class="text-5xl font-bold text-primary underline">{{ $task->subject->name }}</a>
                <div class="text-3xl font-bold text-secondary">-> {{ $task->name }}</div>
            </div>
            <p class="text-md text-gray-500 mb-5">Teacher: {{ $subject->teacher->name }}</p>
            <div class="badge badge-primary text-xl">Task description</div>

            <p class="text-lg mb-5 ">-> {{ $task->description }}</p>
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
            
            @if($solution && $solution->points !== null)
                <div class="badge badge-success text-lg mt-2">
                    <svg class="size-[1em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g fill="currentColor" stroke-linejoin="miter" stroke-linecap="butt">
                            <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor"
                                stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></circle>
                            <path d="m12,17v-5.5c0-.276-.224-.5-.5-.5h-1.5" fill="none" stroke="currentColor"
                                stroke-linecap="square" stroke-miterlimit="10" stroke-width="2"></path>
                            <circle cx="12" cy="7.25" r="1.25" fill="currentColor" stroke-width="2"></circle>
                        </g>
                    </svg>
                    ->Grade: {{ $solution->points }}/{{ $task->points }}
                </div>
            @endif
            
            @if(session('success'))
                <div class="alert alert-success mt-5">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('student.tasks.submit', [$subject, $task]) }}" method="POST" enctype="multipart/form-data" class="mt-10">
                @csrf
                <div class="flex justify-center">
                    <input type="file" name="file" class="mt-5 file-input file-input-primary" required />
                </div>
                <div class="flex justify-center mt-5">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            
            @if($solution)
                <div class="mt-10 p-5 border rounded-lg">
                    <h3 class="text-xl font-bold mb-3">Your Previous Submission</h3>
                    <p>Submitted: {{ $solution->created_at->format('M d, Y H:i') }}</p>
                    <p>File: {{ $solution->content }}</p>
                </div>
            @endif
        </div>
    </div>
</x-layout>
