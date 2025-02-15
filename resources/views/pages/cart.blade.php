@extends('template.app')
@section('content')
    <style>
        body {
            margin: 0 auto;
            width: 100%;
        }

        .cart-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .cart-items {
            margin-bottom: 20px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .cart-item img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            border-radius: 5px;
        }

        .item-details h3 {
            margin: 0;
            font-size: 16px;
        }

        .item-details p {
            margin: 5px 0;
        }

        .quantity {
            width: 50px;
            padding: 5px;
        }

        .cart-summary {
            text-align: center;
        }

        .cart-summary h3 {
            margin-bottom: 10px;
        }

        .cart-summary button {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .cart-summary button:hover {
            background: #218838;
        }
    </style>
    <div class="cart-container">
        <h2>Корзина</h2>
        <div class="cart-items">
            @forelse($cartItems as $item)
                <div class="cart-item">
                    <img src="{{ asset('storage/' . $item->product->images->first()->url) }}" alt="Товар 1">
                    <div class="item-details">
                        <h3>{{ $item->product->title }}</h3>
                        <p>Цена: <span class="price">{{ $item->product->price }}</span> руб.</p>
                        <form action="{{ route('cart.count.remove', $item->id) }}" method="post">
                            @csrf
                            <button>-</button>
                        </form>
                        <p>{{ $item->count }}</p>
                        <form action="{{ route('cart.count.add', $item->id) }}" method="post">
                            @csrf
                            <button>+</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>Ваша корзина пуста</p>
            @endforelse
        </div>
        <div class="cart-summary">
            <h3>Общая сумма: <span id="total-price">{{ $total }}</span> руб.</h3>
            <button onclick="checkout()">Оформить заказ</button>
        </div>
    </div>

@endsection

