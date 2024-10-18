<x-layout>
    <div class="login">
        <h2>Форма входа для учителей и директора</h2>
        <form action="{{ route('login') }}" method="POST" class="login-form">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Войти</button>
            </div>
        </form>
    </div>
</x-layout>
