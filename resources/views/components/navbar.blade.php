<nav>
    <ul id="mainMenu">
        <li><a href="#home">Beranda</a></li>
        <li><a href="#services">Layanan</a></li>
        <li><a href="#booking">Booking</a></li>
        <li><a href="#gallery">Galeri</a></li>
        <li><a href="#testimonials">Testimoni</a></li>
        <li><a href="#contact">Kontak</a></li>
        @guest
            <li><a href="{{ route('login') }}" class="nav-btn login">Login</a></li>
            <li><a href="{{ route('register') }}" class="nav-btn register">Register</a></li>
        @else
            <li><span class="nav-user">{{ Auth::user()->name }}</span></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-btn logout">Logout</button>
                </form>
            </li>
        @endguest
    </ul>
</nav>