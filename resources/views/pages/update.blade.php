@extends('template.app')
@section('content')

<main>
    <!-- В реальном приложении ID и текущие данные товара подтягиваются из БД -->
    <form action="{{ route('product.update', $product->id) }}" method="post" class="form-container" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="product-name">Название</label>
            <input
                    type="text"
                    id="product-name"
                    name="title"
                    value="{{ $product->title }}"

            />
        </div>
        @error('title')
        <div>
            {{ $message }}
        </div>
        @enderror
        <div class="form-group">
            <label for="product-price">Цена</label>
            <input
                    type="number"
                    id="product-price"
                    name="price"
                    step="0.01"
                    value="{{ $product->price }}"
            />
        </div>
        @error('price')
        <div>
            {{ $message }}
        </div>
        @enderror

        <input type="file" name="image[]" id="" multiple>
        @error('image')
        <div>
            {{ $message }}
        </div>
        @enderror

        {{-- <img src="{{ asset('storage/' . $product->image ) }}" style="width: 50px;" alt=""> --}}

        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
</main>
@endsection
