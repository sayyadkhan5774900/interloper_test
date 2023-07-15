@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Product Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
                <p class="card-text"><strong>Price:</strong> {{ $product->price }}</p>
                <p class="card-text"><strong>Quantity:</strong> {{ $product->quantity }}</p>
                <p class="card-text">
                    <strong>Image:</strong>
                    @if ($product->image)
                        <img src="{{ asset('images/' . $product->image) }}" alt="Product Image" width="200">
                    @else
                        No Image
                    @endif
                </p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>

