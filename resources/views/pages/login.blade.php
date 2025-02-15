@extends('template.app')
@section('content')

<main>
    <form action="{{ route('login') }}" method="post" class="form-container">
        @csrf
        <div class="form-group">
            <label for="login-email">Email или логин</label>
            <input type="text" id="login-email" name="email" />
        </div>

        @error('email')
        <div>{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="login-password">Пароль</label>
            <input type="password" id="login-password" name="password" />
        </div>

        @error('email')
        <div>{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Войти</button>

        <div class="links">
            <a href="register.html">Зарегистрироваться</a>
        </div>
    </form>
</main>
@endsection