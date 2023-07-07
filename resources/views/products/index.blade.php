@extends('layout.layout')

@section('content')
<style>
    .custom-heading {
        color: #333;
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .custom-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 16px;
    }

    .custom-button:hover {
        background-color: #45a049;
    }

    .table {
        border-collapse: collapse;
        width: 100%;
    }

    .table th, .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .table th {
        background-color: #f2f2f2;
    }

    .table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table tr:hover {
        background-color: #f5f5f5;
    }
</style>


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="custom-heading">Crud Application</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success custom-button" href="{{ route('products.create') }}">Create New Product</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered mt-4">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Product Code</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
        @foreach($products as $list)
            <tr>
                <td>{{$list->id}}</td>
                <td>{{$list->name}}</td>
                <td>{{$list->description}}</td>
                <td>{{$list->price}}</td>
                <td>{{$list->quantity}}</td>
                <td>{{$list->product_code}}</td>
                <td><img src="{{asset('images/'.$list->product_image)}}" width="50px" height="50px" alt="image"></td>
                <td>
                    <div class="d-flex">
                        <a class="btn btn-primary me-2" href="{{ route('products.edit',$list->id) }}">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('products.destroy',$list->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
