@extends('template.app')
@section('content')
<main>
    <form action="{{ route('register') }}" method="post" class="form-container">
        <div class="form-group">
            <label for="register-name">Имя</label>
            <input type="text" id="register-name" name="name" value="{{ old('name') }}"/>
        </div>

        @csrf

        @error('name')
            <div>
                {{ $message }}
            </div>
        @enderror

        <div class="form-group">
            <label for="register-email">Email</label>
            <input type="email" id="register-email" name="email" value="{{ old('email') }}"/>
        </div>

        @error('email')
            <div>
                {{ $message }}
            </div>
        @enderror

        <div class="form-group">
            <label for="register-password">Пароль</label>
            <input type="password" id="register-password" name="password" />
        </div>

        @error('password')
            <div>
                {{ $message }}
            </div>
        @enderror

        <div class="form-group">
            <label for="register-password">Подтверждение пароля</label>
            <input type="password" id="register-password" name="password_confirmation" />
        </div>

        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>

        <div class="links">
            <a href="login.html">Есть аккаунт? Войти</a>
        </div>
    </form>
</main>
@endsection
