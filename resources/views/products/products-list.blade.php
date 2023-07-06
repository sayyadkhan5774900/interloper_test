@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="card-header d-flex justify-content-between mb-2">
                <h3>Products Lists</h3>
                <button href="javascript:void(0)" id="add_products">
                    <i class="fa fa-plus"></i> Product
                </button>
            </div>
            <table class="table table-striped">
                @if(count(@$products)>0)
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(@$products as $product)
                    <tr>
                        <td>{{ucfirst(@$product->name)}}</td>
                        <td>{{@$product->description}}</td>
                        <td>{{@$product->price}}</td>
                        <td>{{@$product->quantity}}</td>
                        <td>
                            <div class="d-flex justify-contet-around">
                                <button href="javascript:void(0)" class="mx-3 product-edit" data-id="{{ @$product->id }}">Edit</button>
                                <form method="POST" action="{{ route('destroy-products', $product->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are You Sure?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @else
                <div class="alert alert-secondary">
                    No record found
                </div>
                @endif
            </table>
            @if ($products->hasPages())
            <nav>
                <ul class="pagination">
                    @if ($products->onFirstPage())
                    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span aria-hidden="true">Previous</span>
                    </li>
                    @else
                    <li class="me-3">
                        <a href="{{ $products->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
                    </li>
                    @endif

                    @if ($products->hasMorePages())
                    <li class="mx-3">
                        <a href="{{ $products->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
                    </li>
                    @else
                    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span aria-hidden="true">Next</span>
                    </li>
                    @endif
                </ul>
            </nav>
            @endif
        </div>
    </div>
</div>
@endsection