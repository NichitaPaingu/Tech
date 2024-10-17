<x-layout>
    <div class="container">
        <h2>Форма входа для учителей и директора</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <button type="submit">Войти</button>
            </div>
        </form>
    </div>
</x-layout>
