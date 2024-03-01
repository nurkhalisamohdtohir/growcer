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
                <li class="breadcrumb-item">Milo Smoothies</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-7 pt-3 mb-3">
    <div class="container">
        <div class="row ">
            <div class="col-md-5">
                <img src="{{ asset('front-assets/images/smoothies.jpg') }}" alt="" style="width:450px; height:550px; float: right;">
            </div>
            <div class="col-md-7">
                <div class="bg-light right">
                    <h1>Milo Smoothies</h1><br>

                    <h5><strong>Ingredients</strong></h5><br>
                    <p>
                        1 cup milk<br>
                        1 tablespoon milo<br>
                        1 scoop vanilla ice cream<br>
                        1 cup ice<br>
                    </p><br>
                    <h5><strong>Methods</strong></h5><br>
                    <p>
                        1. Place milk, milo, vanilla ice cream, and ice in a blender and blitz to combine.<br>
                        2. Pour into a glass and serve.<br>
                    </p><br>
                </div>
            </div>
        </div>           
    </div>
</section>

<section class="pt-5 section-8">
    <div class="container">
        <div class="section-title">
            <h2>Related Products</h2>
        </div> 
        <div class="row pb-3">
            @if($products->isNotEmpty())
            @foreach ($products as $product)
            <div class="col-md-3">
                <div class="card product-card">
                    <div class="product-image position-relative">
                        <a href="" class="product-img"><img class="card-img-top" src="{{ asset('admin-assets/image/' . $product->image) }}" alt=""></a>
                        <a class="whishlist" href="222"><i class="far fa-heart"></i></a>                            

                        <div class="product-action">
                            <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }});">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </a>                            
                        </div>
                    </div>                        
                    <div class="card-body text-center mt-3">
                        <a class="h6 link" href="">{{ $product->name }}</a>
                        <div class="price mt-2">
                            <span class="h6"><strong>RM {{ number_format($product->price, 2) }}</strong></span>
                        </div>
                    </div>                        
                </div> 
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
@endsection