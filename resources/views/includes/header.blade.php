<header>
    <h1>Вход в систему</h1>
    <nav>
        <ul>
            <li><a href="{{ route('main') }}">Главная</a></li>
            <li><a href="{{ route('product') }}">Список товаров</a></li>

            @auth

                <li><a href="{{ route('view.cart') }}">Корзина</a></li>
                <li><a href="{{ route('view.profile') }}">Профиль</a></li>
                <li><a href="{{ route('create') }}">Добавить товар</a></li>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit">Выйти</button>
                </form>
            @endauth

            @guest
                <li><a href="{{ route('view.login') }}">Войти</a></li>
                <li><a href="{{ route('view.register') }}">Регистрация</a></li>
            @endguest

        </ul>
    </nav>
</header>
