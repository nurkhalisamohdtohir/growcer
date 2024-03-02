@extends('front.layouts.app')

@section('content')
<header class="bg-dark">
	<div class="container">
		<nav class="navbar navbar-expand-xl" id="navbar">
			<a href="index.php" class="text-decoration-none mobile-logo">
				<span class="h2 text-uppercase text-primary bg-dark">Online</span>
				<span class="h2 text-uppercase text-white px-2">SHOP</span>
			</a>
			<button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      			<!-- <span class="navbar-toggler-icon icon-menu"></span> -->
				  <i class="navbar-toggler-icon fas fa-bars"></i>
    		</button>
    		<div class="collapse navbar-collapse" id="navbarSupportedContent">
      			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
        			<!-- <li class="nav-item">
          				<a class="nav-link active" aria-current="page" href="index.php" title="Products">Home</a>
        			</li> -->

                    
					<li class="nav-item dropdown">
						<button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
							Categories
						</button>
						<ul class="dropdown-menu dropdown-menu-dark">
							@if(getCategories()->isNotEmpty())
								@foreach (getCategories() as $category)
								<li><a class="dropdown-item nav-link" href="#">{{$category->name}}</a></li>
								@endforeach
							@endif
						</ul>
					</li>
                    <li class="nav-item dropdown">
						<button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
							Recipes
						</button>
						<ul class="dropdown-menu dropdown-menu-dark">
							@if($recipes->isNotEmpty())
                        	@foreach ($recipes as $recipe)
							<li><a class="dropdown-item nav-link" href="{{ route('front.recipe',$recipe) }}">{{ $recipe }} </a></li>
							@endforeach
                        	@endif 
						</ul>
					</li>
      			</ul>      			
      		</div>   
			<div class="right-nav py-0">
				<a href="{{ route('front.cart') }}" class="ml-3 d-flex pt-2">
					<i class="fas fa-shopping-cart text-primary"></i>					
				</a>
			</div> 		
      	</nav>
  	</div>
</header>


<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
                <li class="breadcrumb-item">Cart</li>
            </ol>
        </div>
    </div>
</section>

<section class=" section-9 pt-4">
    <div class="container">
        <div class="row">
            @if (Session::has('success'))
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            @if (Session::has('error'))
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif

            @if(Cart::count() > 0)
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table" id="cart">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartContent as $item)
                            <tr>
                                <td class="text-start">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('admin-assets/image/' . $item->options->productImage) }}" >
                                        <h2>{{ $item->name }}</h2>
                                    </div>
                                </td>
                                <td>RM {{ number_format($item->price, 2) }}</td>
                                <td>
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1 sub" data-id="{{ $item->rowId }}">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm  border-0 text-center" value="{{ $item->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1 add" data-id="{{ $item->rowId }}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    RM {{ number_format($item->price*$item->qty, 2) }}
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger" onclick="deleteItem('{{ $item->rowId }}')"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>  
                            @endforeach                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">            
                <div class="card cart-summery">
                    <div class="sub-title">
                        <h2 class="bg-white">Cart Summary</h3>
                    </div> 
                    <div class="card-body">
                        <div class="d-flex justify-content-between pb-2">
                            <div>Subtotal</div>
                            <div>RM {{ Cart::subtotal() }}</div>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <div>Shipping</div>
                            <div>RM 0</div>
                        </div>
                        <div class="d-flex justify-content-between summery-end">
                            <div>Total</div>
                            <div>RM {{ Cart::subtotal() }}</div>
                        </div>
                        <div class="pt-5">
                            <a href="login.php" class="btn-dark btn btn-block w-100">Proceed to Checkout</a>
                        </div>
                    </div>
                </div> 
            </div>
            @else
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h4>Your Cart is empty!</h4>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>
$('.add').click(function(){
        var qtyElement = $(this).parent().prev(); 
        var qtyValue = parseInt(qtyElement.val());
        if (qtyValue < 10) {
            qtyElement.val(qtyValue+1);

            var rowId = $(this).data('id');
            var newQty = qtyElement.val();
            updateCart(rowId,newQty)
        }            
    });

$('.sub').click(function(){
    var qtyElement = $(this).parent().next(); 
    var qtyValue = parseInt(qtyElement.val());
    if (qtyValue > 1) {
        qtyElement.val(qtyValue-1);

        var rowId = $(this).data('id');
        var newQty = qtyElement.val();
        updateCart(rowId,newQty)
    }        
});

function updateCart(rowId,qty) {
    $.ajax({
        url: '{{ route("front.updateCart") }}',
        type: 'post',
        data: {rowId:rowId, qty:qty},
        dataType: 'json',
        success: function(response) {
            window.location.href = '{{ route("front.cart") }}';
        }
    });
}   

function deleteItem(rowId) {
    if(confirm("Are you sure you want to delete?")) {

        $.ajax({
            url: '{{ route("front.deleteItem.cart") }}',
            type: 'post',
            data: {rowId:rowId},
            dataType: 'json',
            success: function(response) {
                window.location.href = '{{ route("front.cart") }}';
            }
        });

    }
} 
</script>
@endsection