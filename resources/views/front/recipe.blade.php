@extends('front.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
                <li class="breadcrumb-item">Bubur Ayam</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-7 pt-3 mb-3">
    <div class="container">
        <div class="row ">
            <div class="col-md-5">
                <img src="{{ asset('front-assets/images/bubur.jpg') }}" alt="" style="width:350px; height:450px; float: right;">
            </div>
            <div class="col-md-7">
                <div class="bg-light right">
                    <h1>Bubur Ayam</h1><br>

                    <h5><strong>Ingredients</strong></h5><br>
                    <p>
                        1 cup rice<br>
                        8 cups water<br>
                        2 pieces chicken breast, sliced<br>
                        Chopped Green Onions<br>
                        White pepper<br>
                        Soy Sauce<br>
                    </p><br>
                    <h5><strong>Methods</strong></h5><br>
                    <p>
                        1. Wash rice till water runs clear in rice pot.<br>
                        2. Add water, ginger, chicken, sesame oil, salt, and pepper.<br>
                        3. Press cook. This will take about an hour.<br>
                        4. Stir occasionally to prevent rice from sticking to the bottom.<br>
                        5. If it’s still too watery, cook it longer and if it’s too thick, add more water.<br>
                        6. Add choice of condiments. Serve.<br>
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