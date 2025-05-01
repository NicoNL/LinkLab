<x-layout title="LinkLab | Create Task">
    <div class="min-h-screen space-y-10">
        <h1 class="text-5xl font-bold text-primary text-center">New Task</h1>
        <div class="flex justify-center items-center">
            <form class="card bg-base-300 w-full max-w-md shrink-0 shadow-2xl"
                action="{{ route('teacher.tasks.store', $subject) }}" method="POST">
                @csrf
                <div class="card-body">
                    <fieldset class="fieldset space-y-5">
                        <div class="flex flex-col my-3 space-y-3">
                            <label class="fieldset-label mr-3">Name</label>
                            <input name="name" type="text" class="input" placeholder="Task Name" required
                                autofocus />
                        </div>
                        <div class="flex flex-col my-3 space-y-3">
                            <label class="fieldset-label mr-3">Description</label>
                            <textarea name="description" class="textarea" placeholder="Description" required autofocus></textarea>
                        </div>

                        <div class="flex flex-col my-3 space-y-3">
                            <label class="fieldset-label mr-3">Points</label>
                            <input name="points" type="number" class="input" placeholder="Points" required
                                autofocus />
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" class="btn btn-xl btn-info mt-10">Create Task</button>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
        @if ($errors->any())
            <div class="toast">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-error">
                        <span>{{ $error }}</span>
                    </div>
                @endforeach
            </div>
            <script>
                setTimeout(() => {
                    document.querySelector('.toast').remove();
                }, 5000);
            </script>
        @endif
    </div>
</x-layout>
