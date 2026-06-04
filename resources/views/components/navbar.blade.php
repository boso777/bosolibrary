<div class="px-4 mt-6 w-full relative z-50">
    <div class="flex items-center justify-between px-6 py-3 shadow-lg max-w-4xl rounded-full mx-auto c-bg-dark border border-gray-800 relative">

        {{-- Logo --}}
        <a href="/" class="text-xl font-bold font-secondary c-text-secondary tracking-tight">
            @auth
            {{Auth::user()->name}}
            @endauth
            @guest
            You
            @endguest
            <span class="c-text-primary">Lib</span>
        </a>

        {{-- Nav desktop --}}
        <nav class="hidden md:flex items-center gap-8 text-sm font-medium c-text-secondary font-primary">
            @auth <a class=" transition-colors" href="{{ route('books.index') }}">All Books</a> @endauth
            <a class=" transition-colors" href="@auth {{ route('books.create') }} @endauth @guest {{ route('login') }} @endguest">Add Book</a>
            <a class=" transition-colors" href="{{ route('books.index') }}">About us</a>
            <a class=" transition-colors" href="{{ route('books.index') }}">Coffee time</a>
        </nav>

        {{-- CTA desktop + hamburger mobile --}}
        <div class="flex items-center gap-3">
            @guest
                <a href="{{ route('login') }}"
                   class="hidden md:inline-flex c-bg-primary c-text-secondary px-5 py-2 rounded-full text-sm font-semibold hover:opacity-90 transition shadow-sm">
                    Sign In
                </a>
            @endguest

            @auth
                <form action="{{ route('logout') }}" method="POST" class="hidden md:block">
                    @csrf
                    <button type="submit"
                        class="c-bg-primary c-text-secondary px-5 py-2 rounded-full text-sm font-semibold hover:opacity-90 transition shadow-sm">
                        Logout
                    </button>
                </form>
            @endauth

            {{-- Hamburger --}}
            <button id="openMenu" class="md:hidden c-text-secondary  transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Menu mobile --}}
    <div id="mobileMenu"
         class="hidden md:hidden max-w-4xl mx-auto mt-2 c-bg-dark border border-gray-800 rounded-2xl shadow-xl px-6 py-4 flex flex-col gap-4 text-sm c-text-secondary font-primary">
        @auth <a class="block py-2" href="{{ route('books.index') }}">All Books</a> @endauth
        <a class="block py-2" href="@auth {{ route('books.create') }} @endauth @guest {{ route('login') }} @endguest">Add Book</a>
        <a class="block py-2" href="#">About us</a>
        <a class="block py-2" href="#">Coffee time</a>

        @guest
            <a href="{{ route('login') }}"
               class="custom-btn">
                Sign In
            </a>
        @endguest

        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="c-bg-primary c-text-secondary w-full py-2 rounded-full font-semibold hover:opacity-90 transition">
                    Logout
                </button>
            </form>
        @endauth
    </div>
</div>

<script>
    document.getElementById('openMenu').addEventListener('click', () => {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
        menu.classList.toggle('flex');
    });
</script>