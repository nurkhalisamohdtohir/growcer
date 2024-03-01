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


<section class="section-1">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="false">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <picture>
                    <img src="{{ asset('front-assets/images/carousel1.jpg') }}" alt="" />
                </picture>
            </div>
            <div class="carousel-item">
                <picture>
                    <img src="{{ asset('front-assets/images/carousel2.jpg') }}" alt="" />
                </picture>
            </div>
            <div class="carousel-item">
                <picture>
                    <img src="{{ asset('front-assets/images/carousel3.jpg') }}" alt="" />
                </picture>
            </div>
            <div class="carousel-item">
                <picture>
                    <img src="{{ asset('front-assets/images/carousel4.jpg') }}" alt="" />
                </picture>
            </div>
            <div class="carousel-item">
                <picture>
                    <img src="{{ asset('front-assets/images/carousel5.jpg') }}" alt="" />
                </picture>
            </div>
            <div class="carousel-item">
                <picture>
                    <img src="{{ asset('front-assets/images/carousel6.jpg') }}" alt="" />
                </picture>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<section class="section-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>                    
            </div>
            <div class="col-lg-3 ">
                <div class="box shadow-lg">
                    <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">Free Shipping</h2>
                </div>                    
            </div>
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                </div>                    
            </div>
            <div class="col-lg-3 ">
                <div class="box shadow-lg">
                    <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>                    
            </div>
        </div>
    </div>
</section>
<section class="section-3">
    <div class="container">
        <div class="section-title">
            <h2>Categories</h2>
        </div>           
        <div class="row pb-3">
            <div class="col-lg-3">
                <div class="cat-card">
                    <div class="left">
                        <img src="{{ asset('admin-assets/image/fresh1.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="right">
                        <div class="cat-data">
                            <h2>Fresh Food</h2>
                            <p>100 Products</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="cat-card">
                    <div class="left">
                        <img src="{{ asset('admin-assets/image/frozen1.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="right">
                        <div class="cat-data">
                            <h2>Frozen & Chilled</h2>
                            <p>100 Products</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="cat-card">
                    <div class="left">
                        <img src="{{ asset('admin-assets/image/grocery1.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="right">
                        <div class="cat-data">
                            <h2>Groceries</h2>
                            <p>100 Products</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="cat-card">
                    <div class="left">
                        <img src="{{ asset('admin-assets/image/hb1.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="right">
                        <div class="cat-data">
                            <h2>Health & Beauty</h2>
                            <p>100 Products</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="cat-card">
                    <div class="left">
                        <img src="{{ asset('admin-assets/image/hh1.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="right">
                        <div class="cat-data">
                            <h2>Household</h2>
                            <p>100 Products</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection