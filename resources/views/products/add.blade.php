@extends('layout.layout')
 
@section('content')
  <style>
    .custom-input {
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-size: 16px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      transition: box-shadow 0.3s ease;
    }
    .custom-input:focus {
      outline: none;
      box-shadow: 0 4px 12px rgba(0, 123, 255, 0.5);
    }
    .custom-input::placeholder {
      color: #999;
    }
    .custom-label {
      font-weight: bold;
    }
  </style>
  <title></title>
</head>
<body>
  <div class="container ">
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
    @csrf
      <div class="mb-3">
        <label for="name" class="form-label custom-label">Name</label>
        <input type="text" name="name" class="form-control custom-input" id="name" placeholder="Enter name" requiredd>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label custom-label">Description</label>
        <input type="text" name="description" class="form-control custom-input" id="description" placeholder="Enter description" required>
      </div>
      <div class="mb-3">
        <label for="price" class="form-label custom-label">Price</label>
        <input type="number" name="price" class="form-control custom-input" id="price" placeholder="Enter price" required>
      </div>
      <div class="mb-3">
        <label for="quantity" class="form-label custom-label">Quantity</label>
        <input type="number" name="quantity" class="form-control custom-input" id="quantity" placeholder="Enter quantity" required>
      </div>
      
      <div class="mb-3">
        <label for="product_image" class="form-label custom-label">Product Image</label>
        <input type="file" name="file" class="form-control custom-input" id="product_image">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</html>
@endsection