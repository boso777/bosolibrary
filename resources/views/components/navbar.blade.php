<header class="flex items-center justify-between px-6 py-3 md:py-4 shadow max-w-5xl rounded-full mx-auto w-full bg-white mt-10">
    <a href="/">
        <p>BosoLibrary</p>
    </a>


    <!-- elementi centrali -->
    <nav id="menu" class="max-md:absolute max-md:top-0 max-md:left-0 max-md:overflow-hidden items-center justify-center max-md:h-full max-md:w-0 transition-[width] bg-white/50 backdrop-blur flex-col md:flex-row flex gap-8 text-gray-900 text-sm font-normal">
        <a class="hover:text-indigo-600" href="{{route('books.index')}}">
            All books
        </a>
        <a class="hover:text-indigo-600" href="{{route('books.create')}}">
            Insert new book
        </a>
        
        <button id="closeMenu" class="md:hidden text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </nav>
    

    <!-- sign in e dark theme -->
    @guest
    <div class="flex items-center space-x-4">
        
        <a class="hidden md:flex bg-indigo-600 text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-indigo-700 transition" href="{{route('login')}}">
            Sign up
        </a>
        <button id="openMenu" class="md:hidden text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
    @endguest
 
    @auth
       <div class="flex items-center space-x-4">
                
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="hidden md:flex bg-indigo-600 text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-indigo-700 transition">
                    <Label></Label>Logout
                    </button>
                </form>
                <button id="openMenu" class="md:hidden text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>       
    @endauth
</header>

<script>
    const openMenu = document.getElementById('openMenu');
    const closeMenu = document.getElementById('closeMenu');
    const menu = document.getElementById('menu');

    openMenu.addEventListener('click', () => {
        menu.classList.remove('max-md:w-0');
        menu.classList.add('max-md:w-full');
    });

    closeMenu.addEventListener('click', () => {
        menu.classList.remove('max-md:w-full');
        menu.classList.add('max-md:w-0');
    });
</script>