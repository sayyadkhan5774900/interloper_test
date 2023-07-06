<form id="store_products" name="store_products" action='{{  url("store-products") }}' method="POST">
    @csrf
    <div class="row">
        <input type="hidden" name="product_id" value="{{@$products->id}}">
        <div class="form-group col-sm-12 col-md-6 mb-3">
            <label for="name" class="form-label mb-1">Name</label>
            <input type="text" class="form-control" placeholder="Product Name" id="name" name="name" value="{{@$products->name}}">
        </div>
        <div class="form-group col-sm-12 col-md-6 mb-3">
            <label for="description" class="form-label mb-1">Description</label>
            <input type="text" class="form-control" placeholder="Description" id="description" name="description" value="{{@$products->description}}">
        </div>
        <div class="form-group col-sm-12 col-md-6 mb-3">
            <label for="price" class="form-label mb-1">Price</label>
            <input type="text" class="form-control" placeholder="Price" id="price" name="price" value="{{@$products->price}}">
        </div>
        <div class="form-group col-sm-12 col-md-6 mb-3">
            <label for="quantity" class="form-label mb-1">Quantity</label>
            <input type="number" class="form-control" placeholder="Quantity" id="quantity" name="quantity" value="{{@$products->quantity}}">
        </div>
    </div>
    <div class="mb-4 justify-content-end d-flex">
        <button type="submit"><i class="fa fa-save"></i> Save</button>
    </div>

</form>


<script>
    $(document).ready(function() {
        $("#store_products").validate({
            rules: {
                name: {
                    required: true,
                },
                description: {
                    required: true,
                },
                price: {
                    required: true,
                },
                quantity: {
                    required: true,
                }
            },
            messages: {},

            submitHandler: function(form) {
                return true;
            }

        });
    });
</script>