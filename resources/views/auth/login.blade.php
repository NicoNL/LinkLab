<x-layout title="LinkLab | Login">
    <div class="hero bg-base-300 min-h-screen" style="background-image: url(/assets/wave_background.jpg);">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <form class="card bg-base-300 w-full max-w-md shrink-0 shadow-2xl" action="{{ route('login') }}"
                method="POST">
                @csrf
                <div class="card-body">
                    <h2 class="text-4xl font-bold text-primary text-center">Login</h2>
                    <fieldset class="fieldset space-y-5">
                        <div class="flex flex-col my-3 space-y-3">
                            <label class="fieldset-label mr-3">Email</label>
                            <input name="email" type="email" class="input" placeholder="Email" required
                                autofocus />
                        </div>
                        <div class="flex flex-col my-3 space-y-3">
                            <label class="fieldset-label ">Password</label>
                            <input name="password" type="password" class="input" placeholder="Password" required
                                autofocus />
                        </div>
                        <div class="space-y-2">
                            <a class="underline" href="/register">Create a student account</a>
                        </div>
                        <div class="flex justify-center mt-4">
                            <button type="submit" class="btn btn-xl btn-info">Login</button>
                        </div>
                    </fieldset>
                </div>
            </form>
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
    </div>
</x-layout>
