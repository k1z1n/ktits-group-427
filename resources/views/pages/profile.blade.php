@extends('template.app')
@section('content')
    <h1>Заказы</h1>

    <div>
        @forelse($orders as $order)
           <h4>Заказ под номером #{{ $order->id }} --- {{ $order->total }}</h4>
            @foreach($order->items as $item)
                <p>{{ $item->product->title }}</p>
                <p>{{ $item->product->price }} --- {{ $item->count }}</p>
                <br>
            @endforeach
        @empty
            <p>У вас нет заказов</p>
        @endforelse
    </div>

@endsection
