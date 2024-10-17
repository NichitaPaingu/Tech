<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Школа' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

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

    <div class="container">
        {{ $slot }}
    </div>

</body>
</html>
