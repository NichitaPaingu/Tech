<x-layout>
    <div id="grades" class="grades-container">
        <h2>Классы {{ Auth::user()->role == 'director' ? 'которые вы можете контролировать' : 'в которых вы приподаете:' . Auth::user()->subject->name  }}</h2>
        <div id="grades-list"></div>
    </div>
    <script>
        const authUserId = {{ auth()->user()->id }};
    </script>
</x-layout>
