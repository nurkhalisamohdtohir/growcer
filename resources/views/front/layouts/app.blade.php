<!DOCTYPE html>
<html class="no-js" lang="en_AU" />
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Growcer</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />

	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />

	<meta property="og:locale" content="en_AU" />
	<meta property="og:type" content="website" />
	<meta property="fb:admins" content="" />
	<meta property="fb:app_id" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:image" content="" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="" />
	<meta property="og:image:height" content="" />
	<meta property="og:image:alt" content="" />

	<meta name="twitter:title" content="" />
	<meta name="twitter:site" content="" />
	<meta name="twitter:description" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:image:alt" content="" />
	<meta name="twitter:card" content="summary_large_image" />
	

	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick-theme.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/style.css') }}" />

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">

	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="#" />

	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body data-instant-intensity="mousedown">


<div class="container-fluid" style="background-color: #e62e00;">
	<ul class="nav justify-content-end">
			<li class="nav-item">
				<a class="nav-link text-white" href="{{ route('front.cart') }}"><i class="fas fa-shopping-cart"></i> Cart</a>
			</li>
		@if(Auth::check())
			<li class="nav-item">
				<a class="nav-link text-white" href="{{ route('account.profile') }}"><i class="fas fa-user-alt"></i> Account</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" href="{{ route('account.logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
			</li>
		@else
			<li class="nav-item">
				<a class="nav-link text-white" href="{{ route('account.login') }}"><i class="fas fa-lock"></i> Login</a>
			</li>
		@endif
	</ul>
</div>


<div class="bg-white top-header">        
	<div class="container">
		<div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">
			<div class="col-lg-5 nav justify-content-center">
				<a href="index.php" class="text-decoration-none">
					<img src="{{ asset('front-assets/images/logo.jpg') }}" alt="" style="width:130px; height:130px;">
				</a>
			</div>
			<div class="col-lg-7 text-left  d-flex  align-items-center">
				<form action="{{ route('front.shop') }}" method="get">					
					<div class="input-group">
						<input type="text" placeholder="Search For Products" class="form-control" name="search" value="{{ Request::get('search') }}">
						<button type="submit" class="input-group-text" style="background-color: tomato;">
							<i class="fa fa-search" style="color: white;"></i>
					  	</button>
					</div>
				</form>
			</div>		
		</div>
	</div>
</div>

<header class="bg-white" style="border-bottom: 3px solid tomato;">
	<div class="container">
		<nav class="navbar navbar-expand-xl bg-white navbar-light" id="navbar">
			<a href="{{ route('front.home') }}" class="text-decoration-none mobile-logo">
				<span class="h3 text-capitalize px-2" style="color: #e62e00;">Growcer</span>
			</a>
			<button class="navbar-toggler menu-btn" type="button" style="background-color: #e62e00;" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      			<i class="navbar-toggler-icon"></i>
    		</button>
    		<div class="collapse navbar-collapse" id="navbarSupportedContent">
      			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
        			<li class="nav-item">
          				<a class="nav-link"href="{{ route('front.home') }}">Home</a>
        			</li>
                    <li class="nav-item">
                        <a class="nav-link"href="{{ route('front.shop') }}">All Products</a>
                  </li>
                    <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Recipes</a>
						<ul class="dropdown-menu ">
							@if(getRecipes()->isNotEmpty())
                                @foreach (getRecipes() as $recipe)
                                <li><a class="dropdown-item nav-link" href="{{ route('front.recipe',$recipe) }}">{{ $recipe }} </a></li>
                                @endforeach
                        	@endif 
						</ul>
					</li>
      			</ul>      			
      		</div> 		
      	</nav>
  	</div>
</header>




<main>
    @yield('content')
</main>


<footer class="bg-light mt-5">
	<div class="copyright-area" style="background-color: #e62e00;">
		<div class="container">
			<div class="row">
				<div class="col-12 mt-3">
					<div class="copy-right text-center">
						<p>© Copyright Growcer Stores 2024. All Rights Reserved</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<script src="{{ asset('front-assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
<script src="{{ asset('front-assets/js/instantpages.5.1.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/instantpages.5.1.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/slick.min.js') }}"></script>
<script src="{{ asset('front-assets/js/custom.js') }}"></script>
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

function addToCart(id) {
	$.ajax({
		url: '{{ route("front.addToCart") }}',
		type: 'post',
		data: {id:id},
		dataType: 'json',
		success: function(response) {
			if (response.status == true) {
				window.location.href='{{ route('front.cart') }}';
			} else {
				alert(response.message);
			}
		}
	});
}
</script>

@yield('customJs')
</body>
</html>