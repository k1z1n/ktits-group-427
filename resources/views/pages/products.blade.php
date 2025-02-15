@extends('template.app')
@section('content')

<main>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Фото</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <!-- Пример статических данных -->

        @forelse ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->title}}</td>
            <td>{{ $product->price}}₽</td>
            <td>
                {{-- <img src="{{ asset('storage/' . $product->images->first()->url) }}" alt=""> --}}
                @forelse ($product->images as $image)
                    <img src="{{ asset('storage/' . $image->url) }}" style="width: 40px" alt="">
                @empty
                    изображений нету
                @endforelse
                {{-- <img src="{{ asset('storage/' . $product->image) }}" style="width: 40px" alt=""> --}}
            </td>
            <td>
                <form action="{{ route('cart.add', $product->id) }}" method="post">
                    @csrf
                    <button>Добавить в корзину</button>
                </form>
                <a href="{{ route('view.product.edit', $product->id) }}" class="btn btn-sm">Редактировать</a>
                <a href="{{ route('view.product.delete', $product->id) }}" class="btn btn-sm btn-danger">Удалить</a>
            </td>
        </tr>
        @empty
        <h1>Продуктов нет</h1>

        @endforelse
        </tbody>
    </table>
</main>
@endsection
