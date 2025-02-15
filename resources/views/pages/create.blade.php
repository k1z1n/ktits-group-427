@extends('template.app')
@section('content')

    <main>
        <form action="{{ route('product.store') }}" method="post" class="form-container" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product-name">Название</label>
                <input type="text" id="product-name" name="title" value="{{ old('title') }}"/>
            </div>
            @error('title')
            {{ $message }}
            @enderror

            <div class="form-group">
                <label for="product-price">Цена</label>
                <input type="number" id="product-price" name="price" step="0.01" value="{{ old('price') }}"/>
            </div>
            @error('price')
            {{ $message }}
            @enderror
            <input type="file" name="image[]" id="" multiple>
            @error('image')
            {{ $message }}
            @enderror
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </main>
@endsection
