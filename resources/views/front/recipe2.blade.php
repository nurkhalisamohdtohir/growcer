@extends('front.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="white-text" href="#">Shop</a></li>
                <li class="breadcrumb-item">{{ $recipe }}</li>
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
                    <h1>{{ $recipe }}</h1><br>

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