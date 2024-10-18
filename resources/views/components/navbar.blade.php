<nav class="navbar">
    <div class="navbar-left">
        <ul>
            <li><a href="{{ route('home') }}">Главная</a></li>
            @auth
                <li><a href="{{ route('dashboard') }}">Панель управления</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Выйти</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Войти</a></li>
            @endauth
        </ul>
    </div>

    @auth
        <div class="navbar-right">
            <ul>
                <li><a href="/grades">Управление классами</a></li>
                @if(Auth::user()->role == 'director')
                    <li><a href="/teachers">Управление учителями</a></li>
                @endif
            </ul>
        </div>
    @endauth
</nav>
