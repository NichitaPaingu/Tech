<x-layout>
    <div class="dashboard">
        <h1>Добро пожаловать в нашу школу!</h1>
        <p>Школа предоставляет качественное образование с отличными учителями.</p>

        @auth
            <p>Вы вошли как: {{ Auth::user()->name }}</p>
            <p>Роль: {{ Auth::user()->role == 'director' ? 'Директор' : 'Учитель' }}</p>
            <p>Управление: {{ Auth::user()->role == 'director' ? 'Полное, так как вы являетесь директором' : 'Неполное, вы видите только классы, в которых вы преподаете' }}</p>
        @else
            <p>Пожалуйста, <a href="{{ route('login') }}">войдите</a>, чтобы получить доступ к панели управления.</p>
        @endauth

        <div id="grades" class="grades-container">
            <h2>Классы {{ Auth::user()->role == 'director' ? 'которые вы можете контролировать' : 'в которых вы приподаете:' . Auth::user()->subject->name  }}</h2>
            <div id="grades-list"></div>
        </div>
    </div>

    <script>
        const authUserId = {{ auth()->user()->id }};
    </script>
</x-layout>
