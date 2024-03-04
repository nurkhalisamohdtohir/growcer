@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Product</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <form action="" method="post" id="productForm" name="productForm" enctype="multipart/form-data">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">								
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">	
                                        <p class="error"></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price">Price</label>
                                        <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                                        <p class="error"></p>	
                                    </div>
                                    <div class="mb-3">
                                        <label for="quantity">Quantity</label>
                                        <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity">
                                        <p class="error"></p>	
                                    </div>
                                </div>                                           
                            </div>
                        </div>	                                                                      
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Upload Image</h2>
                            <input type="file" name="image" id="image" class="form-control">
                            <p class="error"></p>
                        </div>	                                                                      
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">	
                            <h2 class="h4 mb-3">Product status</h2>
                            <div class="mb-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Block</option>
                                </select>
                                <p class="error"></p>
                            </div>
                        </div>
                    </div> 
                    <div class="card">
                        <div class="card-body">	
                            <h2 class="h4  mb-3">Product category</h2>
                            <div class="mb-3">
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select Category</option>

                                    @if ($categories->isNotEmpty())
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <p class="error"></p>
                            </div>
                        </div>
                    </div> 
                    <div class="card mb-3">
                        <div class="card-body">	
                            <h2 class="h4 mb-3">Product brand</h2>
                            <div class="mb-3">
                                <select name="brand" id="brand" class="form-control">
                                    <option value="">Select Brand</option>

                                    @if ($brands->isNotEmpty())
                                        @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <p class="error"></p>
                            </div>
                        </div>
                    </div>                                 
                </div>
            </div>
            
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </div>
    </form>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('customJS')
<script>
$("#productForm").submit(function(event){
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled', true);

    // Create a FormData object
    var formData = new FormData(element[0]);

    // Add the file input to FormData
    formData.append('image', $('#image')[0].files[0]);

    $.ajax({
        url: '{{ route("products.store") }}',
        type: 'post',
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(response){
            $("button[type=submit]").prop('disabled', false);

            if(response["status"] == true) {
                window.location.href="{{ route('products.index') }}";

                $("#name").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");
            } else {
                if(response['notFound'] == true) {
                    window.location.href="{{ route('products.index') }}";
                }

                var errors = response['errors'];
                $(".error").removeClass('invalid-feedback').html('');
                $("input[type='text'], select").removeClass('is-invalid');

                $.each(errors, function(key,value){
                    $(`#${key}`).addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(value);
                });
            }
        }, 
        error: function(jqXHR, exception){
            console.log("Something went wrong");
        }
    });
});
</script>
@endsection