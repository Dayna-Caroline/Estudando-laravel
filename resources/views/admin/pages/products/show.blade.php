@extends('admin.layouts.app')

@section('title', 'Detalhes do produto')


@section('content')

    <h1>Produto {{ $product->name }} <a href="{{ route('products.index') }}"><<</a></h1>

    <ul>
        <li><strong>Name: </strong>{{ $product->name }}</li>
        <li><strong>Descrição: </strong>{{ $product->description }}</li>
        <li><strong>Preço: </strong>R${{ $product->price }}</li>
    </ul>

    <form action="{{ route('products.destroy', $product->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Deletar o produto: {{ $product->name }}</button>
    </form>
@endsection