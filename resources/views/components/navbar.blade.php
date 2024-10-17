<nav>
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
</nav>
