@extends('template.app')
@section('content')

<main>
    <div class="delete-confirmation">
        <!-- В реальном приложении здесь должна быть информация о товаре из БД -->
        <p>Вы уверены, что хотите удалить товар <strong>{{ $product->title }}</strong>?</p>
        <form action="{{ route('product.delete', $product->id) }}" method="post">
            <button type="submit" class="btn btn-danger">Удалить</button>
            @csrf
            @method('DELETE')
        </form>
    </div>
</main>
@endsection
