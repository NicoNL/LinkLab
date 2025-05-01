<x-layout title="LinkLab | Edit Subject">
    <div class="min-h-screen space-y-10">
    <h1 class="text-5xl font-bold text-primary text-center">Edit Subject</h1>
    <div class="flex justify-center items-center">
        <form class="card bg-base-300 w-full max-w-md shrink-0 shadow-2xl" action="{{ route('teacher.subjects.update', $subject) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <fieldset class="fieldset space-y-5">
                    <div class="flex flex-col my-3 space-y-3">
                        <label class="fieldset-label mr-3">Name</label>
                        <input name="name" type="text" class="input" placeholder="Subject Name" value="{{ $subject->name }}" required autofocus />
                    </div>
                    <div class="flex flex-col my-3 space-y-3">
                        <label class="fieldset-label mr-3">Description</label>
                        <textarea name="description" class="textarea" placeholder="Description" required autofocus>{{ $subject->description }}</textarea>
                    </div>
                    <div class="flex flex-col my-3 space-y-3">
                        <label class="fieldset-label mr-3">Code</label>
                        <input name="code" type="text" class="input" placeholder="IK-SSSNNN" value="{{ $subject->code }}" required autofocus />
                    </div>
                    <div class="flex flex-col my-3 space-y-3">
                        <label class="fieldset-label mr-3">Credit</label>
                        <input name="credit" type="number" class="input" placeholder="Credit" value="{{ $subject->credit }}" required autofocus />
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="btn btn-xl btn-info mt-10">Update Subject</button>
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
