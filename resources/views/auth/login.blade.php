<x-layout>

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    
    @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-500 p-4 rounded-lg mb-6">
                <ul class="font-primary text-sm">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
      @endif

    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white font-secondary uppercase tracking-widest">
        Sign in to <span class="c-text-primary">YouLib</span>
    </h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form action="{{route('login')}}" method="POST" class="space-y-6">
      @csrf
      <div>
        <label for="email" class="block text-sm/6 font-medium text-gray-100 font-primary">Email address</label>
        <div class="mt-2">
          <input name="email" id="email" type="email" required autocomplete="email" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 sm:text-sm/6 transition-all duration-200" />
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-100 font-primary">Password</label>
          <div class="text-sm">
            <a href="#" class="font-semibold c-text-primary hover:opacity-80 transition-opacity">Forgot password?</a>
          </div>
        </div>
        <div class="mt-2">
          <input name="password" id="password" type="password" required autocomplete="current-password" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 sm:text-sm/6 transition-all duration-200" />
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md c-bg-primary px-3 py-1.5 text-sm/6 font-semibold c-text-secondary hover:opacity-90 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 mt-10 transition-all duration-200 shadow-lg">
            Sign In
        </button>
      </div>
    </form>

    <p class="mt-10 text-center text-sm/6 text-gray-400 font-primary">
      Not registered yet?
      <a href="{{route('register')}}" class="font-semibold c-text-primary hover:opacity-80 transition-opacity">Register now</a>
    </p>
  </div>
</div>

</x-layout>