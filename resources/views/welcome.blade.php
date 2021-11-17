<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">



    </head>
    <body>
    <div class="row mt-4">
        <div class="col-md-8 offset-md-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Add Product
            </button>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody id="productTable">
                    @include('table')
                </tbody>
            </table>
        </div>
    </div>



    <!-- Modal Start -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('product.store') }}" method="POST" id="addProduct">
                    @csrf
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" name="product_name" class="form-control" id="productName" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="productDetails" class="form-label">Product Details</label>
                        <textarea class="form-control" name="product_details" id="" cols="30" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                    <button type="reset" id="reset" class="btn btn-warning">Reset</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="productEditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('product.edit') }}" method="POST" id="editProduct">
                    @csrf
                    <input type="hidden" name="product_id" value="" id="editProductId">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" id="editProductName" name="product_name" class="form-control" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="productDetails" class="form-label">Product Details</label>
                        <textarea id="editProductDetails" class="form-control" name="product_details" id="" cols="30" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <button type="reset" id="reset" class="btn btn-warning">Reset</button>
                </form>
            </div>
            </div>
        </div>
    </div>
    <!-- End Edit Modal -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Modal End -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
    <script>
        jQuery('#addProduct').submit(function(e){
            e.preventDefault();
            let url = $(this).attr('action');
            let data = $(this).serialize(); 
            let method = $(this).attr('method');
            
            $.ajax({
                url : url,
                data : data,
                success : function(){
                    $.get('{{ route('product.list') }}',function(data){
                        $('#productTable').empty().html(data);
                        $('#staticBackdrop').modal('hide');
                        $('#reset').click();
                    });
                },
                type : method,
            });
        });

        // Show Product Edit Modal 
        function showProductEditModal(id,name,details){
            $('#editProductName').val(name);
            $('#editProductId').val(id);
            $('#editProductDetails').val(details);
            $('#productEditModal').modal('show');
        }
        jQuery('#editProduct').submit(function(e){
            e.preventDefault();
            let url = $(this).attr('action');
            let data = $(this).serialize(); 
            let method = $(this).attr('method');
            $.ajax({
                url : url,
                data : data,
                success : function(){
                    $.get('{{ route('product.list') }}',function(data){
                        $('#productTable').empty().html(data);
                        $('#productEditModal').modal('hide');
                        $('#reset').click();
                    });
                },
                type : method,
            });
        });
        function productDelete(id)
        {
            $.get('{{ route('product.delete') }}',{product_id : id},function(){
                $.get('{{ route('product.list') }}',function(data){
                    $('#productTable').empty().html(data);
                });
            });
        }
    </script>

    </body>
    
</html>
