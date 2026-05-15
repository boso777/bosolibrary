<div class="px-4 mt-6 w-full">
    <div class="flex items-center justify-between px-6 py-3 shadow max-w-4xl rounded-full mx-auto bg-white relative">

        {{-- Logo --}}
        <a href="/" class="text-sm font-semibold text-gray-900">BosoLibrary</a>

        {{-- Nav desktop --}}
        <nav class="hidden md:flex items-center gap-8 text-sm font-normal text-gray-900">
            <a class="hover:text-indigo-600" href="{{ route('books.index') }}">All books</a>
            <a class="hover:text-indigo-600" href="{{ route('books.create') }}">Insert new book</a>
        </nav>

        {{-- CTA desktop + hamburger mobile --}}
        <div class="flex items-center gap-3">
            @guest
                <a href="{{ route('login') }}"
                   class="hidden md:inline-flex bg-indigo-600 text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-indigo-700 transition">
                    Sign in
                </a>
            @endguest

            @auth
                <form action="{{ route('logout') }}" method="POST" class="hidden md:block">
                    @csrf
                    <button type="submit"
                        class="bg-indigo-600 text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-indigo-700 transition">
                        Logout
                    </button>
                </form>
            @endauth

            {{-- Hamburger --}}
            <button id="openMenu" class="md:hidden text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Menu mobile: dropdown sotto la pill, non overlay --}}
    <div id="mobileMenu"
         class="hidden md:hidden max-w-4xl mx-auto mt-2 bg-white rounded-2xl shadow px-6 py-4 flex flex-col gap-4 text-sm text-gray-900">
        <a class="hover:text-indigo-600" href="{{ route('books.index') }}">All books</a>
        <a class="hover:text-indigo-600" href="{{ route('books.create') }}">Insert new book</a>

        @guest
            <a href="{{ route('login') }}"
               class="inline-flex justify-center bg-indigo-600 text-white px-5 py-2 rounded-full font-medium hover:bg-indigo-700 transition">
                Sign in
            </a>
        @endguest

        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full bg-indigo-600 text-white px-5 py-2 rounded-full font-medium hover:bg-indigo-700 transition">
                    Logout
                </button>
            </form>
        @endauth
    </div>
</div>

<script>
    document.getElementById('openMenu').addEventListener('click', () => {
        document.getElementById('mobileMenu').classList.toggle('hidden');
        document.getElementById('mobileMenu').classList.toggle('flex');
    });
</script>